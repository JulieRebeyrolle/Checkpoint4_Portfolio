<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210205015733 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE portfolio (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, resume LONGTEXT DEFAULT NULL, cover_picture VARCHAR(255) DEFAULT NULL, cover_file VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio_skills (portfolio_id INT NOT NULL, skills_id INT NOT NULL, INDEX IDX_D3DAFB45B96B5643 (portfolio_id), INDEX IDX_D3DAFB457FF61858 (skills_id), PRIMARY KEY(portfolio_id, skills_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE portfolio_skills ADD CONSTRAINT FK_D3DAFB45B96B5643 FOREIGN KEY (portfolio_id) REFERENCES portfolio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portfolio_skills ADD CONSTRAINT FK_D3DAFB457FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE portfolio_skills DROP FOREIGN KEY FK_D3DAFB45B96B5643');
        $this->addSql('DROP TABLE portfolio');
        $this->addSql('DROP TABLE portfolio_skills');
    }
}
