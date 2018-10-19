<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181018153030 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post ADD picture_file_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE follow DROP INDEX UNIQ_68344470AC24F853, ADD INDEX IDX_68344470AC24F853 (follower_id)');
        $this->addSql('ALTER TABLE follow DROP INDEX UNIQ_683444701816E3A3, ADD INDEX IDX_683444701816E3A3 (following_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE follow DROP INDEX IDX_68344470AC24F853, ADD UNIQUE INDEX UNIQ_68344470AC24F853 (follower_id)');
        $this->addSql('ALTER TABLE follow DROP INDEX IDX_683444701816E3A3, ADD UNIQUE INDEX UNIQ_683444701816E3A3 (following_id)');
        $this->addSql('ALTER TABLE post DROP picture_file_name');
    }
}
