<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250611133142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT '(DC2Type:json)', avatar VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE account_code (account_id INT NOT NULL, code_id INT NOT NULL, INDEX IDX_FB86B7329B6B5FBA (account_id), INDEX IDX_FB86B73227DAFE17 (code_id), PRIMARY KEY(account_id, code_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, wording VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_64C19C115F91DD2 (wording), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE code (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, language_id INT DEFAULT NULL, category_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, visibility TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', chunk VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_771530989506712E (chunk), INDEX IDX_77153098F675F31B (author_id), INDEX IDX_7715309882F1BAF4 (language_id), INDEX IDX_7715309812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_D4DB71B5EA750E8 (label), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE account_code ADD CONSTRAINT FK_FB86B7329B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE account_code ADD CONSTRAINT FK_FB86B73227DAFE17 FOREIGN KEY (code_id) REFERENCES code (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE code ADD CONSTRAINT FK_77153098F675F31B FOREIGN KEY (author_id) REFERENCES account (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE code ADD CONSTRAINT FK_7715309882F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE code ADD CONSTRAINT FK_7715309812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE account_code DROP FOREIGN KEY FK_FB86B7329B6B5FBA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE account_code DROP FOREIGN KEY FK_FB86B73227DAFE17
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE code DROP FOREIGN KEY FK_77153098F675F31B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE code DROP FOREIGN KEY FK_7715309882F1BAF4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE code DROP FOREIGN KEY FK_7715309812469DE2
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE account
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE account_code
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE category
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE code
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE language
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
