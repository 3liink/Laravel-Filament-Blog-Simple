<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $pluralModelLabel = 'บทความ';
    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('title')->label("หัวเรื่อง")->columnSpanFull()->required(),
            RichEditor::make('content')->label('บทความ')->columnSpanFull()->required(),
            Select::make('tags')
                ->label('แท็ก')
                ->multiple()
                ->relationship('tags', 'name')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->required()
                ])
                ->columnSpanFull()
                ->required(),
            FileUpload::make('cover')->label('ปกบทความ')->columnSpanFull()->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('เรื่อง'),
                ImageColumn::make('cover')->label('ภาพปก'),
                TextColumn::make('tags.name')->label('แท็ก'),
                TextColumn::make('user.name')->label('ผู้เขียน'),
                TextColumn::make('created_at')->label('สร้างเมื่อ'),
                TextColumn::make('updated_at')->label('แก้ไขล่าสุด'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->label('แก้ไข')
                ->modalHeading('แก้ไขบทความ')
                ->modalSubmitActionLabel('แก้ไข')
                ->modalCancelActionLabel('ยกเลิก'),
                Tables\Actions\DeleteAction::make()
                ->label('ลบ'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('ลบที่เลือก'),
                ])->label('ดำเนินการทั้งหมด'),
            ])
            ->paginated([10, 25, 50, 100, 'ทั้งหมด']);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBlogs::route('/'),
        ];
    }
}
