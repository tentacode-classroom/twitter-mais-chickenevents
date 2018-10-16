<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181015134910 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, body VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE follow (id INT AUTO_INCREMENT NOT NULL, follower_id INT NOT NULL, following_id INT NOT NULL, UNIQUE INDEX UNIQ_68344470AC24F853 (follower_id), UNIQUE INDEX UNIQ_683444701816E3A3 (following_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE follow ADD CONSTRAINT FK_68344470AC24F853 FOREIGN KEY (follower_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE follow ADD CONSTRAINT FK_683444701816E3A3 FOREIGN KEY (following_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE follow');
    }
}
