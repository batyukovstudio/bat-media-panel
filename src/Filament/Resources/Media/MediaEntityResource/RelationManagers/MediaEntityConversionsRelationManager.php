<?php

namespace Batyukovstudio\BatMedia\Filament\Resources\Media\MediaEntityResource\RelationManagers;

use Batyukovstudio\BatMedia\Filament\Components\AdminComponents\FormComponent;
use Batyukovstudio\BatMedia\Filament\Components\Models\Media;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MediaEntityConversionsRelationManager extends RelationManager
{
    protected static string $relationship = 'mediaEntityConversions';
    protected static ?string $title = 'Конверсии';
    protected static ?string $label = 'Конверсию';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FormComponent::nameFormComponent()
                    ->columnSpanFull(),
                Media::formSchemaMediaConversion()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns(Media::tableColumnsMediaConversion())
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
