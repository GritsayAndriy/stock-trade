<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230121163042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "currency_pairs_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "currency_pairs" (id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "currency_pairs".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "currency_pairs".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE offers DROP CONSTRAINT fk_da46042767b3b43d');
        $this->addSql('DROP INDEX idx_da46042767b3b43d');
        $this->addSql('ALTER TABLE offers ADD currency_pair_id INT NOT NULL');
        $this->addSql('ALTER TABLE offers RENAME COLUMN users_id TO user_id');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427A76ED395 FOREIGN KEY (user_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427A311484C FOREIGN KEY (currency_pair_id) REFERENCES "currency_pairs" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DA460427A76ED395 ON offers (user_id)');
        $this->addSql('CREATE INDEX IDX_DA460427A311484C ON offers (currency_pair_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "offers" DROP CONSTRAINT FK_DA460427A311484C');
        $this->addSql('DROP SEQUENCE "currency_pairs_id_seq" CASCADE');
        $this->addSql('DROP TABLE "currency_pairs"');
        $this->addSql('ALTER TABLE "offers" DROP CONSTRAINT FK_DA460427A76ED395');
        $this->addSql('DROP INDEX IDX_DA460427A76ED395');
        $this->addSql('DROP INDEX IDX_DA460427A311484C');
        $this->addSql('ALTER TABLE "offers" ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE "offers" DROP user_id');
        $this->addSql('ALTER TABLE "offers" DROP currency_pair_id');
        $this->addSql('ALTER TABLE "offers" ADD CONSTRAINT fk_da46042767b3b43d FOREIGN KEY (users_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_da46042767b3b43d ON "offers" (users_id)');
    }
}
