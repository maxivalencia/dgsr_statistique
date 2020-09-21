<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200921132345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ct_const_av_deds_const_av_ded_caracs');
        $this->addSql('ALTER TABLE ct_type_droit_ptac CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE ct_usage_tarif DROP FOREIGN KEY FK_FA9D5B819C6EC188');
        $this->addSql('ALTER TABLE ct_usage_tarif DROP FOREIGN KEY FK_FA9D5B81B48AD363');
        $this->addSql('ALTER TABLE ct_usage_tarif ADD CONSTRAINT FK_FA9D5B819C6EC188 FOREIGN KEY (ct_type_visite_id) REFERENCES ct_type_visite (id)');
        $this->addSql('ALTER TABLE ct_usage_tarif ADD CONSTRAINT FK_FA9D5B81B48AD363 FOREIGN KEY (ct_usage_id) REFERENCES ct_usage (id)');
        $this->addSql('ALTER TABLE ct_visite_anomalie ADD id INT AUTO_INCREMENT NOT NULL, CHANGE ct_anomalie_id ct_anomalie_id INT NOT NULL, CHANGE ct_visite_id ct_visite_id INT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE ct_visite_visite_extra DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ct_visite_visite_extra ADD PRIMARY KEY (ct_visite_extra_id, ct_visite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_const_av_deds_const_av_ded_caracs (const_av_ded_id INT NOT NULL, const_av_ded_carac_id INT NOT NULL, INDEX IDX_58B3C67AE4B53355 (const_av_ded_id), INDEX IDX_58B3C67A1E94B9F2 (const_av_ded_carac_id), PRIMARY KEY(const_av_ded_id, const_av_ded_carac_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ct_const_av_deds_const_av_ded_caracs ADD CONSTRAINT FK_58B3C67A1E94B9F2 FOREIGN KEY (const_av_ded_carac_id) REFERENCES ct_const_av_ded_carac (id)');
        $this->addSql('ALTER TABLE ct_const_av_deds_const_av_ded_caracs ADD CONSTRAINT FK_58B3C67AE4B53355 FOREIGN KEY (const_av_ded_id) REFERENCES ct_const_av_ded (id)');
        $this->addSql('ALTER TABLE ct_type_droit_ptac CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE ct_usage_tarif DROP FOREIGN KEY FK_FA9D5B819C6EC188');
        $this->addSql('ALTER TABLE ct_usage_tarif DROP FOREIGN KEY FK_FA9D5B81B48AD363');
        $this->addSql('ALTER TABLE ct_usage_tarif ADD CONSTRAINT FK_FA9D5B819C6EC188 FOREIGN KEY (ct_type_visite_id) REFERENCES ct_type_visite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ct_usage_tarif ADD CONSTRAINT FK_FA9D5B81B48AD363 FOREIGN KEY (ct_usage_id) REFERENCES ct_usage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ct_visite_anomalie MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE ct_visite_anomalie DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ct_visite_anomalie DROP id, CHANGE ct_anomalie_id ct_anomalie_id INT DEFAULT 0 NOT NULL, CHANGE ct_visite_id ct_visite_id INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE ct_visite_visite_extra DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ct_visite_visite_extra ADD PRIMARY KEY (ct_visite_id, ct_visite_extra_id)');
    }
}
