<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200831110904 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_anomalie ADD ct_anomalie VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ct_droit_ptac_backup CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE ct_droit_ptac_bak CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE ct_genre_tarif DROP FOREIGN KEY FK_CD5527BAD74CE6E6');
        $this->addSql('ALTER TABLE ct_genre_tarif ADD CONSTRAINT FK_CD5527BAD74CE6E6 FOREIGN KEY (ct_genre_id) REFERENCES ct_genre (id)');
        $this->addSql('ALTER TABLE ct_motif_tarif DROP FOREIGN KEY FK_110F10F845348DE0');
        $this->addSql('ALTER TABLE ct_motif_tarif ADD CONSTRAINT FK_110F10F845348DE0 FOREIGN KEY (ct_motif_id) REFERENCES ct_motif (id)');
        $this->addSql('ALTER TABLE ct_type_droit_ptac CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE ct_usage_tarif DROP FOREIGN KEY FK_FA9D5B819C6EC188');
        $this->addSql('ALTER TABLE ct_usage_tarif DROP FOREIGN KEY FK_FA9D5B81B48AD363');
        $this->addSql('ALTER TABLE ct_usage_tarif ADD CONSTRAINT FK_FA9D5B819C6EC188 FOREIGN KEY (ct_type_visite_id) REFERENCES ct_type_visite (id)');
        $this->addSql('ALTER TABLE ct_usage_tarif ADD CONSTRAINT FK_FA9D5B81B48AD363 FOREIGN KEY (ct_usage_id) REFERENCES ct_usage (id)');
        $this->addSql('ALTER TABLE ct_visite_anomalie CHANGE ct_anomalie_id ct_anomalie_id INT NOT NULL, CHANGE ct_visite_id ct_visite_id INT NOT NULL');
        $this->addSql('ALTER TABLE ct_visite_visite_extra DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ct_visite_visite_extra ADD PRIMARY KEY (ct_visite_extra_id, ct_visite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_anomalie DROP ct_anomalie');
        $this->addSql('ALTER TABLE ct_droit_ptac_backup CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE ct_droit_ptac_bak CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE ct_genre_tarif DROP FOREIGN KEY FK_CD5527BAD74CE6E6');
        $this->addSql('ALTER TABLE ct_genre_tarif ADD CONSTRAINT FK_CD5527BAD74CE6E6 FOREIGN KEY (ct_genre_id) REFERENCES ct_genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ct_motif_tarif DROP FOREIGN KEY FK_110F10F845348DE0');
        $this->addSql('ALTER TABLE ct_motif_tarif ADD CONSTRAINT FK_110F10F845348DE0 FOREIGN KEY (ct_motif_id) REFERENCES ct_motif (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ct_type_droit_ptac CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE ct_usage_tarif DROP FOREIGN KEY FK_FA9D5B819C6EC188');
        $this->addSql('ALTER TABLE ct_usage_tarif DROP FOREIGN KEY FK_FA9D5B81B48AD363');
        $this->addSql('ALTER TABLE ct_usage_tarif ADD CONSTRAINT FK_FA9D5B819C6EC188 FOREIGN KEY (ct_type_visite_id) REFERENCES ct_type_visite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ct_usage_tarif ADD CONSTRAINT FK_FA9D5B81B48AD363 FOREIGN KEY (ct_usage_id) REFERENCES ct_usage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ct_visite_anomalie CHANGE ct_anomalie_id ct_anomalie_id INT DEFAULT 0 NOT NULL, CHANGE ct_visite_id ct_visite_id INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE ct_visite_visite_extra DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ct_visite_visite_extra ADD PRIMARY KEY (ct_visite_id, ct_visite_extra_id)');
    }
}
