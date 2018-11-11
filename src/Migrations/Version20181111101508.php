<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181111101508 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, firstName VARCHAR(45) DEFAULT NULL, lastName VARCHAR(45) DEFAULT NULL, nickName VARCHAR(45) DEFAULT NULL, phoneNumber INT DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, postCode INT DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6495F37A13B (token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(45) DEFAULT NULL, price_advized DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, size VARCHAR(45) DEFAULT NULL, color VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agenda DROP FOREIGN KEY FK_2CEDC8773414710B');
        $this->addSql('DROP INDEX IDX_2CEDC8773414710B ON agenda');
        $this->addSql('ALTER TABLE agenda CHANGE agent_id team_id INT NOT NULL');
        $this->addSql('ALTER TABLE agenda ADD CONSTRAINT FK_2CEDC877296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_2CEDC877296CD8AE ON agenda (team_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE product');
        $this->addSql('ALTER TABLE agenda DROP FOREIGN KEY FK_2CEDC877296CD8AE');
        $this->addSql('DROP INDEX IDX_2CEDC877296CD8AE ON agenda');
        $this->addSql('ALTER TABLE agenda CHANGE team_id agent_id INT NOT NULL');
        $this->addSql('ALTER TABLE agenda ADD CONSTRAINT FK_2CEDC8773414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('CREATE INDEX IDX_2CEDC8773414710B ON agenda (agent_id)');
    }
}
