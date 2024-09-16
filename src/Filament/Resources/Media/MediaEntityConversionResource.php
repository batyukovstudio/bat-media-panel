<?php

namespace Batyukovstudio\BatMedia\Filament\Resources\Media;

use Batyukovstudio\BatMedia\Filament\Components\AdminComponents\FormComponent;
use Batyukovstudio\BatMedia\Filament\Components\Models\Media;
use Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityConversionResource\Pages;
use Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityConversionResource\RelationManagers\MediaConversionSizeRelationManager;
use Batyukovstudio\BatMedia\MediaEntity\Models\MediaEntity;
use Batyukovstudio\BatMedia\MediaEntity\Models\MediaEntityConversion;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class MediaEntityConversionResource extends Resource
{
    protected static ?string $model = MediaEntityConversion::class;

    protected static ?string $pluralLabel = 'Конверсии';

    protected static ?string $breadcrumb = 'Конверсии';

    protected static ?string $label = 'Конверсии';

    protected static ?string $navigationLabel = 'Конверсии';

    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $navigationGroup = 'Медиа';

    public static function canAccess(): bool
    {
        $user = Auth::guard('web')->user();

        return $user->hasRole('admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FormComponent::nameFormComponent(),
                Select::make('media_entity_id')
                    ->label('Сущность')
                    ->relationship('mediaEntity', 'name')
                    ->preload()
                    ->optionsLimit(10)
                    ->getOptionLabelFromRecordUsing(fn(MediaEntity $record) => $record->getName())
                    ->required()
                    ->required(),
                Section::make('Дополнительные поля')->schema([
                    Media::formSchemaMediaConversion()
                ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(Media::tableColumnsMediaConversion())
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            MediaConversionSizeRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMediaEntityConversions::route('/'),
            'create' => Pages\CreateMediaEntityConversion::route('/create'),
            'edit' => Pages\EditMediaEntityConversion::route('/{record}/edit'),
        ];
    }
}
