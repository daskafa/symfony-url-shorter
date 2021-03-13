<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210313180251 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE homepage_interface ADD features_title VARCHAR(255) NOT NULL, ADD features_description VARCHAR(255) NOT NULL, ADD features_item1_image VARCHAR(255) NOT NULL, ADD features_item1_title VARCHAR(255) NOT NULL, ADD features_item1_description VARCHAR(255) NOT NULL, ADD features_item2_image VARCHAR(255) NOT NULL, ADD features_item2_title VARCHAR(255) NOT NULL, ADD features_item2_description VARCHAR(255) NOT NULL, ADD features_item3_image VARCHAR(255) NOT NULL, ADD features_item3_title VARCHAR(255) NOT NULL, ADD features_item3_description VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE homepage_interface DROP features_title, DROP features_description, DROP features_item1_image, DROP features_item1_title, DROP features_item1_description, DROP features_item2_image, DROP features_item2_title, DROP features_item2_description, DROP features_item3_image, DROP features_item3_title, DROP features_item3_description');
    }
}
