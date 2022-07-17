<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628000019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // @formatter:off
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('
            CREATE TABLE article (
                uuid UUID NOT NULL,
                name VARCHAR(255) NOT NULL,
                PRIMARY KEY(uuid)
            )
        ');
        $this->addSql('COMMENT ON COLUMN article.uuid IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article');
    }
}
