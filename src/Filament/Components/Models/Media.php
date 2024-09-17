<?php

namespace Batyukovstudio\BatMedia\Filament\Components\Models;

use Batyukovstudio\BatMedia\Filament\Components\AdminComponents\FormComponent;
use Batyukovstudio\BatMedia\Filament\Components\AdminComponents\TableComponent;
use Batyukovstudio\BatMedia\MediaEntity\Enums\MediaFormat;
use Batyukovstudio\BatMedia\MediaEntity\Models\MediaConversionSize;
use Batyukovstudio\BatMedia\MediaEntity\Models\MediaEntityConversion;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Arr;

class Media
{
    public static function formSchemaMediaConversion(): Grid
    {
        return Grid::make()->schema([
            FormComponent::descriptionFormComponent()
                ->columnSpanFull(),
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
            Toggle::make('gallery')
                ->label('Галерея'),
            Toggle::make('queued')
                ->live()
                ->label('В очереди')
        ]);
    }

    public static function tableColumnsMediaConversion(): array
    {
        return [
            TableComponent::idTableComponent(),
            TableComponent::nameTableComponent(),
            TextColumn::make('media_entity_id')
                ->label('Сущность')
                ->formatStateUsing(fn(MediaEntityConversion $record) => $record->getMediaEntity()->getName())
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
                ->formatStateUsing(function (MediaEntityConversion $record): string {
                    if ($record->isQueued() === false) {
                        $message = 'Нет';
                    } else {
                        $message = 'Да';
                    }
                    return $message;
                })
                ->toggleable()
        ];
    }

    public static function formSchemaMediaConversionSize(): array
    {
        return [
            Select::make('media_entity_conversion_id')
                ->label('Конверсия')
                ->relationship('mediaEntityConversion', 'id')
                ->preload()
                ->optionsLimit(10)
                ->getOptionLabelFromRecordUsing(fn(MediaEntityConversion $record) => $record->getName())
                ->required(),
            TextInput::make('width')
                ->label('Ширина')
                ->integer()
                ->maxValue(65535),
            TextInput::make('height')
                ->label('Высота')
                ->integer()
                ->maxValue(65535),
            Section::make('Дополнительные поля')->schema([
                TextInput::make('quality')
                    ->label('Качество')
                    ->integer()
                    ->maxValue(100),
                FormComponent::descriptionFormComponent(),
            ])->collapsible(),
        ];
    }

    public static function tableColumnsMediaConversionSize(): array
    {
        return Arr::collapse([
            TableComponent::idTableComponent(),
            [
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->toggleable()
                    ->sortable()
                    ->formatStateUsing(fn(?MediaConversionSize $record) => $record?->getNameValue())
                    ->limit(45),
                TextColumn::make('media_entity')
                    ->label('Сущность')
                    ->state(fn(MediaConversionSize $record) => $record->getMediaEntityConversion()->getMediaEntity()->getName()),
                TextColumn::make('media_entity_conversion_id')
                    ->label('Конверсия')
                    ->formatStateUsing(fn(MediaConversionSize $record) => $record->getMediaEntityConversion()->getName()),
                TextColumn::make('width')
                    ->label('Ширина')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('height')
                    ->label('Высота')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]
        ]);
    }
}
