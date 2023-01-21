<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120141341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "currencies_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "deals_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "offers_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "users_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "wallet_transactions_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "wallets_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "currencies" (id INT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "deals" (id INT NOT NULL, sell_offer_id INT NOT NULL, buy_offer_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EF39849BB2A188F1 ON "deals" (sell_offer_id)');
        $this->addSql('CREATE INDEX IDX_EF39849BA19A413B ON "deals" (buy_offer_id)');
        $this->addSql('COMMENT ON COLUMN "deals".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "deals".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "offers" (id INT NOT NULL, currency_id INT NOT NULL, users_id INT NOT NULL, price NUMERIC(10, 0) NOT NULL, amount INT NOT NULL, type VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, current_amount INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DA46042738248176 ON "offers" (currency_id)');
        $this->addSql('CREATE INDEX IDX_DA46042767B3B43D ON "offers" (users_id)');
        $this->addSql('COMMENT ON COLUMN "offers".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "offers".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "users" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON "users" (email)');
        $this->addSql('CREATE TABLE "wallet_transactions" (id INT NOT NULL, wallet_id INT NOT NULL, amount NUMERIC(10, 0) NOT NULL, type VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A50205E2712520F3 ON "wallet_transactions" (wallet_id)');
        $this->addSql('COMMENT ON COLUMN "wallet_transactions".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "wallet_transactions".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "wallets" (id INT NOT NULL, user_id INT NOT NULL, currency_id INT NOT NULL, amount NUMERIC(10, 2) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_967AAA6CA76ED395 ON "wallets" (user_id)');
        $this->addSql('CREATE INDEX IDX_967AAA6C38248176 ON "wallets" (currency_id)');
        $this->addSql('COMMENT ON COLUMN "wallets".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "wallets".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE "deals" ADD CONSTRAINT FK_EF39849BB2A188F1 FOREIGN KEY (sell_offer_id) REFERENCES "offers" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "deals" ADD CONSTRAINT FK_EF39849BA19A413B FOREIGN KEY (buy_offer_id) REFERENCES "offers" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "offers" ADD CONSTRAINT FK_DA46042738248176 FOREIGN KEY (currency_id) REFERENCES "currencies" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "offers" ADD CONSTRAINT FK_DA46042767B3B43D FOREIGN KEY (users_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "wallet_transactions" ADD CONSTRAINT FK_A50205E2712520F3 FOREIGN KEY (wallet_id) REFERENCES "wallets" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "wallets" ADD CONSTRAINT FK_967AAA6CA76ED395 FOREIGN KEY (user_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "wallets" ADD CONSTRAINT FK_967AAA6C38248176 FOREIGN KEY (currency_id) REFERENCES "currencies" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "currencies_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "deals_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "offers_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "users_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "wallet_transactions_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "wallets_id_seq" CASCADE');
        $this->addSql('ALTER TABLE "deals" DROP CONSTRAINT FK_EF39849BB2A188F1');
        $this->addSql('ALTER TABLE "deals" DROP CONSTRAINT FK_EF39849BA19A413B');
        $this->addSql('ALTER TABLE "offers" DROP CONSTRAINT FK_DA46042738248176');
        $this->addSql('ALTER TABLE "offers" DROP CONSTRAINT FK_DA46042767B3B43D');
        $this->addSql('ALTER TABLE "wallet_transactions" DROP CONSTRAINT FK_A50205E2712520F3');
        $this->addSql('ALTER TABLE "wallets" DROP CONSTRAINT FK_967AAA6CA76ED395');
        $this->addSql('ALTER TABLE "wallets" DROP CONSTRAINT FK_967AAA6C38248176');
        $this->addSql('DROP TABLE "currencies"');
        $this->addSql('DROP TABLE "deals"');
        $this->addSql('DROP TABLE "offers"');
        $this->addSql('DROP TABLE "users"');
        $this->addSql('DROP TABLE "wallet_transactions"');
        $this->addSql('DROP TABLE "wallets"');
    }
}
