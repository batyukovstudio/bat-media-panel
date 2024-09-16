<?php

namespace Batyukovstudio\BatMedia\Filament\Resources\Media;

use Batyukovstudio\BatMedia\Filament\Components\AdminComponents\FormComponent;
use Batyukovstudio\BatMedia\Filament\Components\AdminComponents\TableComponent;
use Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityResource\Pages;
use Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityResource\RelationManagers\MediaEntityConversionsRelationManager;
use Batyukovstudio\BatMedia\MediaEntity\Enums\MediaFormat;
use Batyukovstudio\BatMedia\MediaEntity\Models\MediaEntity;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class MediaEntityResource extends Resource
{
    protected static ?string $pluralLabel = 'Медиа сущностей';

    protected static ?string $breadcrumb = 'Медиа сущностей';

    protected static ?string $label = 'Медиа сущности';

    protected static ?string $navigationLabel = 'Медиа сущностей';
    protected static ?string $model = MediaEntity::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';
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
                TextInput::make('entity_class')
                    ->label('Класс сущности')
                    ->required()
                    ->maxLength(191),
                Section::make('Дополнительные поля')->schema([
                    FormComponent::descriptionFormComponent(),
                    Grid::make()->schema([
                        TextInput::make('width')
                            ->label('Ширина')
                            ->integer()
                            ->maxValue(65535),
                        TextInput::make('height')
                            ->label('Высота')
                            ->integer()
                            ->maxValue(65535),
                        TextInput::make('quality')
                            ->label('Качество')
                            ->integer()
                            ->maxValue(100),
                        Select::make('format')
                            ->label('Формат')
                            ->options(MediaFormat::LABELS)
                            ->enum(MediaFormat::class),
                    ])->columns(4),
                    Toggle::make('queued')
                        ->live()
                        ->label('В очереди')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        $tableColumns = Arr::collapse([
            TableComponent::idAndNameTableComponents(),
            [
                TextColumn::make('entity_class')
                    ->label('Класс сущности')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('width')
                    ->label('Ширина')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('height')
                    ->label('Высота')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('quality')
                    ->label('Качество')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('format')
                    ->label('Формат')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('queued')
                    ->label('В очереди')
                    ->searchable()
                    ->formatStateUsing(function (MediaEntity $record): string {
                        if ($record->isQueued() === false) {
                            $message = 'Нет';
                        } else {
                            $message = 'Да';
                        }
                        return $message;
                    })
                    ->toggleable(),
            ]
        ]);

        return $table
            ->columns($tableColumns)
            ->filters([
                SelectFilter::make('id')
                    ->label('Сущность')
                    ->options(fn() => MediaEntity::all()->pluck('name', 'id'))
                    ->default(fn() => MediaEntity::query()->first()->getKey())
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('regenerate')
                    ->action(function (MediaEntity $record) {
                        Artisan::call('media-library:regenerate', [$record->getEntityClass()]);
                    })
                    ->label('Regen'),
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
            MediaEntityConversionsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMediaEntities::route('/'),
            'create' => Pages\CreateMediaEntity::route('/create'),
            'edit' => Pages\EditMediaEntity::route('/{record}/edit'),
        ];
    }
}
