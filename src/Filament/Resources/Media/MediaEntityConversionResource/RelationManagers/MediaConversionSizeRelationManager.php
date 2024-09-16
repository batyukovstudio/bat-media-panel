<?php

namespace Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityConversionResource\RelationManagers;

use Batyukovstudio\BatMedia\Filament\Components\AdminComponents\FormComponent;
use Batyukovstudio\BatMedia\Filament\Components\Models\Media;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Arr;

class MediaConversionSizeRelationManager extends RelationManager
{

    protected static ?string $title = 'Размеры медиа сущности';
    protected static string $relationship = 'mediaConversionSizes';
    protected static ?string $pluralLabel = 'Размеры';
    protected static ?string $breadcrumb = 'Размеры';
    protected static ?string $label = 'размер';
    protected static ?string $navigationLabel = 'Размеры';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public function form(Form $form): Form
    {
        $schema = Arr::collapse([[
            FormComponent::nameFormComponent()],
            Media::formSchemaMediaConversionSize()
        ]);
        return $form
            ->schema($schema);

    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns(Media::tableColumnsMediaConversionSize())
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
