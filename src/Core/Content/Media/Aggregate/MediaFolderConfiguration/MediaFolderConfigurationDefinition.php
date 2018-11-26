<?php declare(strict_types=1);

namespace Shopware\Core\Content\Media\Aggregate\MediaFolderConfiguration;

use Shopware\Core\Content\Media\Aggregate\MediaFolder\MediaFolderDefinition;
use Shopware\Core\Content\Media\Aggregate\MediaFolderConfigurationThumbnailSize\MediaFolderConfigurationThumbnailSizeDefinition;
use Shopware\Core\Content\Media\Aggregate\ThumbnailSize\ThumbnailSizeDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\CreatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\UpdatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\VersionField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Write\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Write\Flag\Required;

class MediaFolderConfigurationDefinition extends EntityDefinition
{
    public static function getEntityName(): string
    {
        return 'media_folder_configuration';
    }

    public static function getCollectionClass(): string
    {
        return MediaFolderConfigurationCollection::class;
    }

    public static function getStructClass(): string
    {
        return MediaFolderConfigurationStruct::class;
    }

    protected static function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->setFlags(new PrimaryKey(), new Required()),
            new VersionField(),

            new BoolField('auto_create_thumbnails', 'autoCreateThumbnails'),

            new OneToManyAssociationField(
                'mediaFolder',
                MediaFolderDefinition::class,
                'media_configuration_id',
                false),

            new ManyToManyAssociationField(
                'thumbnailSizes',
                ThumbnailSizeDefinition::class,
                MediaFolderConfigurationThumbnailSizeDefinition::class,
                true,
                'media_folder_configuration_id',
                'thumbnail_size_id'
            ),

            new CreatedAtField(),
            new UpdatedAtField(),
        ]);
    }
}
