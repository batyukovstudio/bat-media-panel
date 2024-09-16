<?php

namespace Batyukovstudio\BatMedia\Filament\Resources\Media;

use Batyukovstudio\BatMedia\Filament\Components\Models\Media;
use Batyukovstudio\BatMedia\Filament\Resources\Media\MediaConversionSizeResource\Pages;
use Batyukovstudio\BatMedia\MediaEntity\Enums\MediaSize;
use Batyukovstudio\BatMedia\MediaEntity\Models\MediaConversionSize;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class MediaConversionSizeResource extends Resource
{
    protected static ?string $pluralLabel = 'Размеры конверсий';

    protected static ?string $breadcrumb = 'Размеры конверсий';

    protected static ?string $label = 'Размеры конверсии';

    protected static ?string $navigationLabel = 'Размеры конверсий';
    protected static ?string $model = MediaConversionSize::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Медиа';

    public static function canAccess(): bool
    {
        $user = Auth::guard('web')->user();

        return $user->hasRole('admin');
    }

    public static function form(Form $form): Form
    {
        $schema = Arr::collapse([[
            Select::make('name')
                ->label('Название')
                ->selectablePlaceholder(false)
                ->default(MediaSize::MEDIUM)
                ->options(MediaSize::LABELS)
                ->enum(MediaSize::class)
                ->required()],
            Media::formSchemaMediaConversionSize()
        ]);
        return $form
            ->schema($schema);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns(Media::tableColumnsMediaConversionSize())
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMediaConversionSizes::route('/'),
            'create' => Pages\CreateMediaConversionSize::route('/create'),
            'edit' => Pages\EditMediaConversionSize::route('/{record}/edit'),
        ];
    }
}
