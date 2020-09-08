<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200901082433 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_anomalie (id INT AUTO_INCREMENT NOT NULL, ct_anomalie_type_id INT DEFAULT NULL, anml_libelle VARCHAR(100) DEFAULT NULL, anml_code VARCHAR(10) DEFAULT NULL, ct_anomalie VARCHAR(255) NOT NULL, INDEX fk_ct_anomalie_ct_anomalie_type1_idx (ct_anomalie_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_anomalie_type (id INT AUTO_INCREMENT NOT NULL, atp_libelle VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_carosserie (id INT AUTO_INCREMENT NOT NULL, crs_libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_carte_grise (id INT AUTO_INCREMENT NOT NULL, ct_vehicule_id INT DEFAULT NULL, ct_source_energie_id INT DEFAULT NULL, ct_centre_id INT DEFAULT NULL, ct_zone_deserte_id INT DEFAULT NULL, ct_carosserie_id INT DEFAULT NULL, cg_date_emission DATE DEFAULT NULL, cg_nom VARCHAR(255) DEFAULT NULL, cg_prenom VARCHAR(255) DEFAULT NULL, cg_profession VARCHAR(255) DEFAULT NULL, cg_adresse VARCHAR(255) DEFAULT NULL, cg_commune VARCHAR(255) DEFAULT NULL, cg_nbr_assis INT DEFAULT NULL, cg_nbr_debout INT DEFAULT NULL, cg_puissance_admin INT DEFAULT NULL, cg_mise_en_service DATE DEFAULT NULL, cg_patente VARCHAR(255) DEFAULT NULL, cg_ani VARCHAR(255) DEFAULT NULL, cg_rta VARCHAR(255) DEFAULT NULL, cg_num_carte_violette VARCHAR(255) DEFAULT NULL, cg_date_carte_violette DATE DEFAULT NULL, cg_lieu_carte_violette VARCHAR(255) DEFAULT NULL, cg_num_vignette VARCHAR(255) DEFAULT NULL, cg_date_vignette DATE DEFAULT NULL, cg_lieu_vignette VARCHAR(255) DEFAULT NULL, cg_immatriculation VARCHAR(45) DEFAULT NULL, cg_created DATETIME DEFAULT NULL, cg_nom_cooperative VARCHAR(100) DEFAULT NULL, cg_itineraire VARCHAR(100) DEFAULT NULL, cg_is_transport TINYINT(1) NOT NULL, cg_num_identification VARCHAR(45) DEFAULT NULL, cg_zone_deserte VARCHAR(255) DEFAULT NULL, INDEX fk_ct_carte_grise_ct_carosserie1_idx (ct_carosserie_id), INDEX fk_ct_carte_grise_ct_vehicule1_idx (ct_vehicule_id), INDEX FK_A447BE73C50880EA (ct_zone_deserte_id), INDEX fk_ct_carte_grise_ct_source_energie1_idx (ct_source_energie_id), INDEX fk_ct_carte_grise_ct_centre1_idx (ct_centre_id), UNIQUE INDEX UNIQ_A447BE7316321FAD (cg_immatriculation), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_centre (id INT AUTO_INCREMENT NOT NULL, ct_province_id INT DEFAULT NULL, ctr_nom VARCHAR(255) DEFAULT NULL, ctr_code VARCHAR(255) DEFAULT NULL, ctr_created_at DATETIME DEFAULT NULL, ctr_updated_at DATETIME DEFAULT NULL, INDEX fk_ct_centre_ct_province1_idx (ct_province_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_const_av_ded (id INT AUTO_INCREMENT NOT NULL, ct_centre_id INT DEFAULT NULL, ct_verificateur_id INT DEFAULT NULL, cad_provenance VARCHAR(45) DEFAULT NULL, cad_divers VARCHAR(100) DEFAULT NULL, cad_proprietaire_nom VARCHAR(100) DEFAULT NULL, cad_proprietaire_adresse VARCHAR(100) DEFAULT NULL, cad_bon_etat TINYINT(1) DEFAULT NULL, cad_sec_pers TINYINT(1) DEFAULT NULL, cad_sec_march TINYINT(1) DEFAULT NULL, cad_protec_env TINYINT(1) DEFAULT NULL, cad_numero VARCHAR(45) DEFAULT NULL, cad_immatriculation VARCHAR(45) DEFAULT NULL, cad_date_embarquement DATETIME DEFAULT NULL, cad_lieu_embarquement VARCHAR(45) DEFAULT NULL, cad_created DATETIME DEFAULT NULL, cad_conforme TINYINT(1) DEFAULT NULL, cad_observation VARCHAR(255) DEFAULT NULL, INDEX fk_ct_const_av_ded_ct_centre1_idx (ct_centre_id), INDEX fk_ct_const_av_ded_ct_user1_idx (ct_verificateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_const_av_deds_const_av_ded_caracs (const_av_ded_id INT NOT NULL, const_av_ded_carac_id INT NOT NULL, INDEX IDX_58B3C67AE4B53355 (const_av_ded_id), INDEX IDX_58B3C67A1E94B9F2 (const_av_ded_carac_id), PRIMARY KEY(const_av_ded_id, const_av_ded_carac_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_const_av_ded_carac (id INT AUTO_INCREMENT NOT NULL, ct_source_energie_id INT DEFAULT NULL, ct_marque_id INT DEFAULT NULL, ct_const_av_ded_type_id INT DEFAULT NULL, ct_genre_id INT DEFAULT NULL, ct_carosserie_id INT DEFAULT NULL, cad_cylindre VARCHAR(10) DEFAULT NULL, cad_puissance DOUBLE PRECISION DEFAULT NULL, cad_poids_vide DOUBLE PRECISION DEFAULT NULL, cad_charge_utile DOUBLE PRECISION DEFAULT NULL, cad_hauteur DOUBLE PRECISION DEFAULT NULL, cad_largeur DOUBLE PRECISION DEFAULT NULL, cad_longueur DOUBLE PRECISION DEFAULT NULL, cad_num_serie_type VARCHAR(100) DEFAULT NULL, cad_num_moteur VARCHAR(100) DEFAULT NULL, cad_type_car VARCHAR(45) DEFAULT NULL, cad_poids_maxima TEXT DEFAULT NULL, cad_poids_total_charge DOUBLE PRECISION DEFAULT NULL, cad_premiere_circule VARCHAR(100) DEFAULT NULL, cad_nbr_assis INT DEFAULT NULL, INDEX fk_ct_const_av_ded_carac_ct_carosserie1_idx (ct_carosserie_id), INDEX fk_ct_const_av_ded_carac_ct_marque1_idx (ct_marque_id), INDEX fk_ct_const_av_ded_carac_ct_source_energie1_idx (ct_source_energie_id), INDEX fk_ct_const_av_ded_carac_ct_const_av_ded_type1_idx (ct_const_av_ded_type_id), INDEX fk_ct_const_av_ded_carac_ct_genre1_idx (ct_genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_const_av_ded_type (id INT AUTO_INCREMENT NOT NULL, cad_tp_libelle VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_droit_ptac (id INT AUTO_INCREMENT NOT NULL, ct_genre_categorie_id INT DEFAULT NULL, ct_type_droit_ptac_id INT DEFAULT NULL, dp_prix_min DOUBLE PRECISION DEFAULT NULL, dp_prix_max DOUBLE PRECISION DEFAULT NULL, dp_droit DOUBLE PRECISION DEFAULT NULL, INDEX IDX_DB918ADA7CFDF4AC (ct_type_droit_ptac_id), INDEX IDX_DB918ADA12DA9529 (ct_genre_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_droit_ptac_backup (id INT AUTO_INCREMENT NOT NULL, ct_genre_categorie_id INT DEFAULT NULL, dp_prix_min DOUBLE PRECISION DEFAULT NULL, dp_prix_max DOUBLE PRECISION DEFAULT NULL, dp_droit DOUBLE PRECISION DEFAULT NULL, ct_type_droit_ptac_id INT DEFAULT NULL, INDEX IDX_DB918ADA7CFDF4AC (ct_type_droit_ptac_id), INDEX IDX_DB918ADA12DA9529 (ct_genre_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_droit_ptac_bak (id INT AUTO_INCREMENT NOT NULL, ct_genre_categorie_id INT DEFAULT NULL, dp_prix_min DOUBLE PRECISION DEFAULT NULL, dp_prix_max DOUBLE PRECISION DEFAULT NULL, dp_droit DOUBLE PRECISION DEFAULT NULL, ct_type_droit_ptac_id INT DEFAULT NULL, INDEX IDX_DB918ADA7CFDF4AC (ct_type_droit_ptac_id), INDEX IDX_DB918ADA12DA9529 (ct_genre_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_genre (id INT AUTO_INCREMENT NOT NULL, ct_genre_categorie_id INT DEFAULT NULL, gr_libelle VARCHAR(255) DEFAULT NULL, gr_code VARCHAR(50) DEFAULT NULL, INDEX IDX_9BCBF2CE12DA9529 (ct_genre_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_genre_categorie (id INT AUTO_INCREMENT NOT NULL, gc_libelle VARCHAR(255) DEFAULT NULL, gc_is_calculable TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_genre_tarif (id INT AUTO_INCREMENT NOT NULL, ct_genre_id INT DEFAULT NULL, grt_prix DOUBLE PRECISION DEFAULT NULL, grt_annee VARCHAR(4) DEFAULT NULL, INDEX fk_ct_genre_tarif_ct_genre1_idx (ct_genre_id), UNIQUE INDEX uk_ct_genre_ct_annee (grt_annee, ct_genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_historique (id INT AUTO_INCREMENT NOT NULL, ct_user_id INT DEFAULT NULL, hst_description LONGTEXT NOT NULL, hst_date_create DATETIME NOT NULL, hst_is_view TINYINT(1) NOT NULL, ct_centre_id INT DEFAULT NULL, hist_type VARCHAR(20) DEFAULT NULL, INDEX IDX_7E72DEE1C211A85D (ct_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_marque (id INT AUTO_INCREMENT NOT NULL, mrq_libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_motif (id INT AUTO_INCREMENT NOT NULL, mtf_libelle VARCHAR(255) DEFAULT NULL, mtf_is_calculable TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_motif_tarif (id INT AUTO_INCREMENT NOT NULL, ct_motif_id INT DEFAULT NULL, mtf_trf_prix DOUBLE PRECISION DEFAULT NULL, mtf_trf_date VARCHAR(4) DEFAULT NULL, INDEX fk_ct_motif_tarif_ct_motif1_idx (ct_motif_id), UNIQUE INDEX uk_ct_motif_ct_mtf_trf_date (mtf_trf_date, ct_motif_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_proces_verbal (id INT AUTO_INCREMENT NOT NULL, pv_type VARCHAR(255) DEFAULT NULL, pv_tarif DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_province (id INT AUTO_INCREMENT NOT NULL, prv_nom VARCHAR(255) DEFAULT NULL, prv_code VARCHAR(255) DEFAULT NULL, prv_created_at DATETIME DEFAULT NULL, prv_updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_reception (id INT AUTO_INCREMENT NOT NULL, ct_vehicule_id INT DEFAULT NULL, ct_motif_id INT DEFAULT NULL, ct_type_reception_id INT DEFAULT NULL, ct_utilisation_id INT DEFAULT NULL, ct_source_energie_id INT DEFAULT NULL, ct_centre_id INT DEFAULT NULL, ct_user_id INT DEFAULT NULL, ct_genre_id INT DEFAULT NULL, ct_carosserie_id INT DEFAULT NULL, rcp_mise_service DATE DEFAULT NULL, rcp_immatriculation VARCHAR(45) DEFAULT NULL, rcp_proprietaire VARCHAR(255) DEFAULT NULL, rcp_profession VARCHAR(100) DEFAULT NULL, rcp_adresse VARCHAR(255) DEFAULT NULL, rcp_nbr_assis INT DEFAULT NULL, rcp_nbr_debout INT DEFAULT NULL, rcp_num_pv VARCHAR(100) DEFAULT NULL, rcp_num_group VARCHAR(255) DEFAULT NULL, rcp_created DATE DEFAULT NULL, INDEX IDX_942215A2F2AE3878 (ct_carosserie_id), INDEX fk_ct_reception_ct_motif1_idx (ct_motif_id), INDEX fk_ct_reception_ct_user1_idx (ct_user_id), INDEX fk_ct_reception_ct_centre1_idx (ct_centre_id), INDEX IDX_942215A27EE62163 (ct_source_energie_id), INDEX IDX_942215A2D74CE6E6 (ct_genre_id), INDEX fk_ct_reception_ct_type_reception1_idx (ct_type_reception_id), INDEX fk_ct_reception_ct_utilisation1_idx (ct_utilisation_id), INDEX fk_ct_reception_ct_vehicule1_idx (ct_vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_reception_backup (id INT AUTO_INCREMENT NOT NULL, ct_centre_id INT DEFAULT NULL, ct_motif_id INT DEFAULT NULL, ct_type_reception_id INT DEFAULT NULL, ct_user_id INT DEFAULT NULL, ct_utilisation_id INT DEFAULT NULL, ct_vehicule_id INT DEFAULT NULL, rcp_mise_service DATE DEFAULT NULL, rcp_immatriculation VARCHAR(45) DEFAULT NULL, rcp_proprietaire VARCHAR(255) DEFAULT NULL, rcp_profession VARCHAR(100) DEFAULT NULL, rcp_adresse VARCHAR(255) DEFAULT NULL, rcp_nbr_assis INT DEFAULT NULL, rcp_nbr_debout INT DEFAULT NULL, rcp_num_pv VARCHAR(100) DEFAULT NULL, ct_source_energie_id INT DEFAULT NULL, ct_carosserie_id INT DEFAULT NULL, rcp_num_group VARCHAR(255) DEFAULT NULL, rcp_created DATE DEFAULT NULL, INDEX fk_ct_reception_ct_user1_idx (ct_user_id), INDEX fk_ct_reception_ct_centre1_idx (ct_centre_id), INDEX IDX_942215A2F2AE3878 (ct_carosserie_id), INDEX fk_ct_reception_ct_motif1_idx (ct_motif_id), INDEX fk_ct_reception_ct_vehicule1_idx (ct_vehicule_id), INDEX IDX_942215A27EE62163 (ct_source_energie_id), INDEX fk_ct_reception_ct_type_reception1_idx (ct_type_reception_id), INDEX fk_ct_reception_ct_utilisation1_idx (ct_utilisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_role (id INT AUTO_INCREMENT NOT NULL, role_name VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_source_energie (id INT AUTO_INCREMENT NOT NULL, sre_libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_type_droit_ptac (id INT AUTO_INCREMENT NOT NULL, tp_dp_libelle VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_type_reception (id INT AUTO_INCREMENT NOT NULL, tprcp_libelle VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_type_usage (id INT AUTO_INCREMENT NOT NULL, tpu_libelle VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_type_visite (id INT AUTO_INCREMENT NOT NULL, tpv_libelle VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_usage (id INT AUTO_INCREMENT NOT NULL, ct_type_usage_id INT DEFAULT NULL, usg_libelle VARCHAR(255) DEFAULT NULL, usg_validite VARCHAR(255) DEFAULT NULL, usg_created DATETIME DEFAULT NULL, INDEX IDX_C8709F46E2563560 (ct_type_usage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_usage_tarif (id INT AUTO_INCREMENT NOT NULL, ct_type_visite_id INT DEFAULT NULL, ct_usage_id INT DEFAULT NULL, usg_trf_annee VARCHAR(4) DEFAULT NULL, usg_trf_prix DOUBLE PRECISION DEFAULT NULL, INDEX fk_ct_usage_tarif_ct_usage1_idx (ct_usage_id), INDEX IDX_FA9D5B819C6EC188 (ct_type_visite_id), UNIQUE INDEX uk_ct_usage_ct_usg_trf_annee_ct_type_visite (usg_trf_annee, ct_usage_id, ct_type_visite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_user (id INT AUTO_INCREMENT NOT NULL, ct_centre_id INT DEFAULT NULL, ct_role_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', usr_name VARCHAR(255) DEFAULT NULL, usr_email VARCHAR(255) DEFAULT NULL, usr_locked TINYINT(1) DEFAULT NULL, usr_password VARCHAR(255) DEFAULT NULL, usr_adresse VARCHAR(255) DEFAULT NULL, usr_token VARCHAR(100) DEFAULT NULL, usr_created_at DATETIME DEFAULT NULL, usr_updated_at DATETIME DEFAULT NULL, usr_locked_update TINYINT(1) DEFAULT NULL, usr_request_update TINYINT(1) NOT NULL, usr_profession VARCHAR(255) DEFAULT NULL, usr_telephone VARCHAR(45) DEFAULT NULL, usr_is_connected TINYINT(1) DEFAULT NULL, usr_presence TINYINT(1) DEFAULT NULL, INDEX IDX_A115979E82C8474E (ct_centre_id), INDEX IDX_A115979EB37C5964 (ct_role_id), UNIQUE INDEX email_canonical_UNIQUE (email_canonical), UNIQUE INDEX username_canonical_UNIQUE (username_canonical), UNIQUE INDEX confirmation_token_UNIQUE (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_utilisation (id INT AUTO_INCREMENT NOT NULL, ut_libelle VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_vehicule (id INT AUTO_INCREMENT NOT NULL, ct_marque_id INT DEFAULT NULL, ct_genre_id INT DEFAULT NULL, vhc_cylindre VARCHAR(10) DEFAULT NULL, vhc_puissance DOUBLE PRECISION DEFAULT NULL, vhc_poids_vide DOUBLE PRECISION DEFAULT NULL, vhc_charge_utile DOUBLE PRECISION DEFAULT NULL, vhc_hauteur DOUBLE PRECISION DEFAULT NULL, vhc_largeur DOUBLE PRECISION DEFAULT NULL, vhc_longueur DOUBLE PRECISION DEFAULT NULL, vhc_num_serie VARCHAR(100) DEFAULT NULL, vhc_num_moteur VARCHAR(100) DEFAULT NULL, vhc_created DATETIME DEFAULT NULL, vhc_provenance VARCHAR(45) DEFAULT NULL, vhc_type VARCHAR(45) DEFAULT NULL, vhc_poids_total_charge DOUBLE PRECISION DEFAULT NULL, INDEX fk_ct_vehicule_ct_genre1_idx (ct_genre_id), INDEX fk_ct_vehicule_ct_marque1_idx (ct_marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_visite (id INT AUTO_INCREMENT NOT NULL, ct_utilisation_id INT DEFAULT NULL, ct_centre_id INT DEFAULT NULL, ct_type_visite_id INT DEFAULT NULL, ct_carte_grise_id INT DEFAULT NULL, ct_usage_id INT DEFAULT NULL, ct_verificateur_id INT DEFAULT NULL, ct_user_id INT DEFAULT NULL, vst_num_pv VARCHAR(255) DEFAULT NULL, vst_num_feuille_caisse VARCHAR(255) DEFAULT NULL, vst_date_expiration DATE DEFAULT NULL, vst_created DATETIME DEFAULT NULL, vst_updated DATETIME DEFAULT NULL, vst_is_apte TINYINT(1) DEFAULT NULL, vst_is_contre_visite TINYINT(1) DEFAULT NULL, vst_duree_reparation VARCHAR(100) DEFAULT NULL, INDEX fk_ct_visite_ct_usage1_idx (ct_usage_id), INDEX fk_ct_visite_ct_type_visite1_idx (ct_type_visite_id), INDEX fk_ct_visite_ct_centre1_idx (ct_centre_id), INDEX IDX_7F3E82E355B81AF1 (ct_utilisation_id), INDEX fk_ct_visite_ct_carte_grise1_idx (ct_carte_grise_id), INDEX fk_ct_visite_ct_user1_idx (ct_user_id), INDEX fk_ct_visite_ct_user2_idx (ct_verificateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_visite_anomalie (id INT AUTO_INCREMENT NOT NULL, ct_anomalie_id INT NOT NULL, ct_visite_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_visite_buckup (id INT AUTO_INCREMENT NOT NULL, ct_carte_grise_id INT DEFAULT NULL, ct_centre_id INT DEFAULT NULL, ct_type_visite_id INT DEFAULT NULL, ct_usage_id INT DEFAULT NULL, ct_user_id INT DEFAULT NULL, ct_verificateur_id INT DEFAULT NULL, vst_num_pv VARCHAR(255) DEFAULT NULL, vst_num_feuille_caisse VARCHAR(255) DEFAULT NULL, vst_date_expiration DATE DEFAULT NULL, vst_created DATETIME DEFAULT NULL, vst_updated DATETIME DEFAULT NULL, ct_utilisation_id INT DEFAULT NULL, vst_is_apte TINYINT(1) NOT NULL, vst_is_contre_visite TINYINT(1) NOT NULL, vst_duree_reparation VARCHAR(100) DEFAULT NULL, INDEX fk_ct_visite_ct_centre1_idx (ct_centre_id), INDEX fk_ct_visite_ct_usage1_idx (ct_usage_id), INDEX fk_ct_visite_ct_type_visite1_idx (ct_type_visite_id), INDEX fk_ct_visite_ct_user2_idx (ct_verificateur_id), INDEX IDX_7F3E82E355B81AF1 (ct_utilisation_id), INDEX fk_ct_visite_ct_carte_grise1_idx (ct_carte_grise_id), INDEX fk_ct_visite_ct_user1_idx (ct_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_visite_extra (id INT AUTO_INCREMENT NOT NULL, vste_libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_visite_visite_extra (ct_visite_extra_id INT NOT NULL, ct_visite_id INT NOT NULL, INDEX IDX_497E418E15D88434 (ct_visite_extra_id), INDEX IDX_497E418E5314CD4 (ct_visite_id), PRIMARY KEY(ct_visite_extra_id, ct_visite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_visite_extra_tarif (id INT AUTO_INCREMENT NOT NULL, ct_visite_extra_id INT DEFAULT NULL, vet_annee VARCHAR(4) DEFAULT NULL, vet_prix DOUBLE PRECISION DEFAULT NULL, INDEX fk_ct_visite_extra_tarif_ct_visite_extra1_idx (ct_visite_extra_id), UNIQUE INDEX uk_ct_visite_extra_ct_vet_annee (vet_annee, ct_visite_extra_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_zone_deserte (id INT AUTO_INCREMENT NOT NULL, zd_libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_anomalie ADD CONSTRAINT FK_E4809465F16CE4D9 FOREIGN KEY (ct_anomalie_type_id) REFERENCES ct_anomalie_type (id)');
        $this->addSql('ALTER TABLE ct_carte_grise ADD CONSTRAINT FK_A447BE73346884A7 FOREIGN KEY (ct_vehicule_id) REFERENCES ct_vehicule (id)');
        $this->addSql('ALTER TABLE ct_carte_grise ADD CONSTRAINT FK_A447BE737EE62163 FOREIGN KEY (ct_source_energie_id) REFERENCES ct_source_energie (id)');
        $this->addSql('ALTER TABLE ct_carte_grise ADD CONSTRAINT FK_A447BE7382C8474E FOREIGN KEY (ct_centre_id) REFERENCES ct_centre (id)');
        $this->addSql('ALTER TABLE ct_carte_grise ADD CONSTRAINT FK_A447BE73C50880EA FOREIGN KEY (ct_zone_deserte_id) REFERENCES ct_zone_deserte (id)');
        $this->addSql('ALTER TABLE ct_carte_grise ADD CONSTRAINT FK_A447BE73F2AE3878 FOREIGN KEY (ct_carosserie_id) REFERENCES ct_carosserie (id)');
        $this->addSql('ALTER TABLE ct_centre ADD CONSTRAINT FK_902E42D9764A0FC FOREIGN KEY (ct_province_id) REFERENCES ct_province (id)');
        $this->addSql('ALTER TABLE ct_const_av_ded ADD CONSTRAINT FK_5116CBD82C8474E FOREIGN KEY (ct_centre_id) REFERENCES ct_centre (id)');
        $this->addSql('ALTER TABLE ct_const_av_ded ADD CONSTRAINT FK_5116CBDBDF4F30F FOREIGN KEY (ct_verificateur_id) REFERENCES ct_user (id)');
        $this->addSql('ALTER TABLE ct_const_av_deds_const_av_ded_caracs ADD CONSTRAINT FK_58B3C67AE4B53355 FOREIGN KEY (const_av_ded_id) REFERENCES ct_const_av_ded (id)');
        $this->addSql('ALTER TABLE ct_const_av_deds_const_av_ded_caracs ADD CONSTRAINT FK_58B3C67A1E94B9F2 FOREIGN KEY (const_av_ded_carac_id) REFERENCES ct_const_av_ded_carac (id)');
        $this->addSql('ALTER TABLE ct_const_av_ded_carac ADD CONSTRAINT FK_FAC238B67EE62163 FOREIGN KEY (ct_source_energie_id) REFERENCES ct_source_energie (id)');
        $this->addSql('ALTER TABLE ct_const_av_ded_carac ADD CONSTRAINT FK_FAC238B68CD3293F FOREIGN KEY (ct_marque_id) REFERENCES ct_marque (id)');
        $this->addSql('ALTER TABLE ct_const_av_ded_carac ADD CONSTRAINT FK_FAC238B6B08BD647 FOREIGN KEY (ct_const_av_ded_type_id) REFERENCES ct_const_av_ded_type (id)');
        $this->addSql('ALTER TABLE ct_const_av_ded_carac ADD CONSTRAINT FK_FAC238B6D74CE6E6 FOREIGN KEY (ct_genre_id) REFERENCES ct_genre (id)');
        $this->addSql('ALTER TABLE ct_const_av_ded_carac ADD CONSTRAINT FK_FAC238B6F2AE3878 FOREIGN KEY (ct_carosserie_id) REFERENCES ct_carosserie (id)');
        $this->addSql('ALTER TABLE ct_droit_ptac ADD CONSTRAINT FK_DB918ADA12DA9529 FOREIGN KEY (ct_genre_categorie_id) REFERENCES ct_genre_categorie (id)');
        $this->addSql('ALTER TABLE ct_droit_ptac ADD CONSTRAINT FK_DB918ADA7CFDF4AC FOREIGN KEY (ct_type_droit_ptac_id) REFERENCES ct_type_droit_ptac (id)');
        $this->addSql('ALTER TABLE ct_genre ADD CONSTRAINT FK_9BCBF2CE12DA9529 FOREIGN KEY (ct_genre_categorie_id) REFERENCES ct_genre_categorie (id)');
        $this->addSql('ALTER TABLE ct_genre_tarif ADD CONSTRAINT FK_CD5527BAD74CE6E6 FOREIGN KEY (ct_genre_id) REFERENCES ct_genre (id)');
        $this->addSql('ALTER TABLE ct_historique ADD CONSTRAINT FK_7E72DEE1C211A85D FOREIGN KEY (ct_user_id) REFERENCES ct_user (id)');
        $this->addSql('ALTER TABLE ct_motif_tarif ADD CONSTRAINT FK_110F10F845348DE0 FOREIGN KEY (ct_motif_id) REFERENCES ct_motif (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A2346884A7 FOREIGN KEY (ct_vehicule_id) REFERENCES ct_vehicule (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A245348DE0 FOREIGN KEY (ct_motif_id) REFERENCES ct_motif (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A24E379674 FOREIGN KEY (ct_type_reception_id) REFERENCES ct_type_reception (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A255B81AF1 FOREIGN KEY (ct_utilisation_id) REFERENCES ct_utilisation (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A27EE62163 FOREIGN KEY (ct_source_energie_id) REFERENCES ct_source_energie (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A282C8474E FOREIGN KEY (ct_centre_id) REFERENCES ct_centre (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A2C211A85D FOREIGN KEY (ct_user_id) REFERENCES ct_user (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A2D74CE6E6 FOREIGN KEY (ct_genre_id) REFERENCES ct_genre (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A2F2AE3878 FOREIGN KEY (ct_carosserie_id) REFERENCES ct_carosserie (id)');
        $this->addSql('ALTER TABLE ct_usage ADD CONSTRAINT FK_C8709F46E2563560 FOREIGN KEY (ct_type_usage_id) REFERENCES ct_type_usage (id)');
        $this->addSql('ALTER TABLE ct_usage_tarif ADD CONSTRAINT FK_FA9D5B819C6EC188 FOREIGN KEY (ct_type_visite_id) REFERENCES ct_type_visite (id)');
        $this->addSql('ALTER TABLE ct_usage_tarif ADD CONSTRAINT FK_FA9D5B81B48AD363 FOREIGN KEY (ct_usage_id) REFERENCES ct_usage (id)');
        $this->addSql('ALTER TABLE ct_user ADD CONSTRAINT FK_A115979E82C8474E FOREIGN KEY (ct_centre_id) REFERENCES ct_centre (id)');
        $this->addSql('ALTER TABLE ct_user ADD CONSTRAINT FK_A115979EB37C5964 FOREIGN KEY (ct_role_id) REFERENCES ct_role (id)');
        $this->addSql('ALTER TABLE ct_vehicule ADD CONSTRAINT FK_BCF5CAE48CD3293F FOREIGN KEY (ct_marque_id) REFERENCES ct_marque (id)');
        $this->addSql('ALTER TABLE ct_vehicule ADD CONSTRAINT FK_BCF5CAE4D74CE6E6 FOREIGN KEY (ct_genre_id) REFERENCES ct_genre (id)');
        $this->addSql('ALTER TABLE ct_visite ADD CONSTRAINT FK_7F3E82E355B81AF1 FOREIGN KEY (ct_utilisation_id) REFERENCES ct_utilisation (id)');
        $this->addSql('ALTER TABLE ct_visite ADD CONSTRAINT FK_7F3E82E382C8474E FOREIGN KEY (ct_centre_id) REFERENCES ct_centre (id)');
        $this->addSql('ALTER TABLE ct_visite ADD CONSTRAINT FK_7F3E82E39C6EC188 FOREIGN KEY (ct_type_visite_id) REFERENCES ct_type_visite (id)');
        $this->addSql('ALTER TABLE ct_visite ADD CONSTRAINT FK_7F3E82E3A2084498 FOREIGN KEY (ct_carte_grise_id) REFERENCES ct_carte_grise (id)');
        $this->addSql('ALTER TABLE ct_visite ADD CONSTRAINT FK_7F3E82E3B48AD363 FOREIGN KEY (ct_usage_id) REFERENCES ct_usage (id)');
        $this->addSql('ALTER TABLE ct_visite ADD CONSTRAINT FK_7F3E82E3BDF4F30F FOREIGN KEY (ct_verificateur_id) REFERENCES ct_user (id)');
        $this->addSql('ALTER TABLE ct_visite ADD CONSTRAINT FK_7F3E82E3C211A85D FOREIGN KEY (ct_user_id) REFERENCES ct_user (id)');
        $this->addSql('ALTER TABLE ct_visite_visite_extra ADD CONSTRAINT FK_497E418E15D88434 FOREIGN KEY (ct_visite_extra_id) REFERENCES ct_visite_extra (id)');
        $this->addSql('ALTER TABLE ct_visite_visite_extra ADD CONSTRAINT FK_497E418E5314CD4 FOREIGN KEY (ct_visite_id) REFERENCES ct_visite (id)');
        $this->addSql('ALTER TABLE ct_visite_extra_tarif ADD CONSTRAINT FK_E3F1985E15D88434 FOREIGN KEY (ct_visite_extra_id) REFERENCES ct_visite_extra (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_anomalie DROP FOREIGN KEY FK_E4809465F16CE4D9');
        $this->addSql('ALTER TABLE ct_carte_grise DROP FOREIGN KEY FK_A447BE73F2AE3878');
        $this->addSql('ALTER TABLE ct_const_av_ded_carac DROP FOREIGN KEY FK_FAC238B6F2AE3878');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A2F2AE3878');
        $this->addSql('ALTER TABLE ct_visite DROP FOREIGN KEY FK_7F3E82E3A2084498');
        $this->addSql('ALTER TABLE ct_carte_grise DROP FOREIGN KEY FK_A447BE7382C8474E');
        $this->addSql('ALTER TABLE ct_const_av_ded DROP FOREIGN KEY FK_5116CBD82C8474E');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A282C8474E');
        $this->addSql('ALTER TABLE ct_user DROP FOREIGN KEY FK_A115979E82C8474E');
        $this->addSql('ALTER TABLE ct_visite DROP FOREIGN KEY FK_7F3E82E382C8474E');
        $this->addSql('ALTER TABLE ct_const_av_deds_const_av_ded_caracs DROP FOREIGN KEY FK_58B3C67AE4B53355');
        $this->addSql('ALTER TABLE ct_const_av_deds_const_av_ded_caracs DROP FOREIGN KEY FK_58B3C67A1E94B9F2');
        $this->addSql('ALTER TABLE ct_const_av_ded_carac DROP FOREIGN KEY FK_FAC238B6B08BD647');
        $this->addSql('ALTER TABLE ct_const_av_ded_carac DROP FOREIGN KEY FK_FAC238B6D74CE6E6');
        $this->addSql('ALTER TABLE ct_genre_tarif DROP FOREIGN KEY FK_CD5527BAD74CE6E6');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A2D74CE6E6');
        $this->addSql('ALTER TABLE ct_vehicule DROP FOREIGN KEY FK_BCF5CAE4D74CE6E6');
        $this->addSql('ALTER TABLE ct_droit_ptac DROP FOREIGN KEY FK_DB918ADA12DA9529');
        $this->addSql('ALTER TABLE ct_genre DROP FOREIGN KEY FK_9BCBF2CE12DA9529');
        $this->addSql('ALTER TABLE ct_const_av_ded_carac DROP FOREIGN KEY FK_FAC238B68CD3293F');
        $this->addSql('ALTER TABLE ct_vehicule DROP FOREIGN KEY FK_BCF5CAE48CD3293F');
        $this->addSql('ALTER TABLE ct_motif_tarif DROP FOREIGN KEY FK_110F10F845348DE0');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A245348DE0');
        $this->addSql('ALTER TABLE ct_centre DROP FOREIGN KEY FK_902E42D9764A0FC');
        $this->addSql('ALTER TABLE ct_user DROP FOREIGN KEY FK_A115979EB37C5964');
        $this->addSql('ALTER TABLE ct_carte_grise DROP FOREIGN KEY FK_A447BE737EE62163');
        $this->addSql('ALTER TABLE ct_const_av_ded_carac DROP FOREIGN KEY FK_FAC238B67EE62163');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A27EE62163');
        $this->addSql('ALTER TABLE ct_droit_ptac DROP FOREIGN KEY FK_DB918ADA7CFDF4AC');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A24E379674');
        $this->addSql('ALTER TABLE ct_usage DROP FOREIGN KEY FK_C8709F46E2563560');
        $this->addSql('ALTER TABLE ct_usage_tarif DROP FOREIGN KEY FK_FA9D5B819C6EC188');
        $this->addSql('ALTER TABLE ct_visite DROP FOREIGN KEY FK_7F3E82E39C6EC188');
        $this->addSql('ALTER TABLE ct_usage_tarif DROP FOREIGN KEY FK_FA9D5B81B48AD363');
        $this->addSql('ALTER TABLE ct_visite DROP FOREIGN KEY FK_7F3E82E3B48AD363');
        $this->addSql('ALTER TABLE ct_const_av_ded DROP FOREIGN KEY FK_5116CBDBDF4F30F');
        $this->addSql('ALTER TABLE ct_historique DROP FOREIGN KEY FK_7E72DEE1C211A85D');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A2C211A85D');
        $this->addSql('ALTER TABLE ct_visite DROP FOREIGN KEY FK_7F3E82E3BDF4F30F');
        $this->addSql('ALTER TABLE ct_visite DROP FOREIGN KEY FK_7F3E82E3C211A85D');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A255B81AF1');
        $this->addSql('ALTER TABLE ct_visite DROP FOREIGN KEY FK_7F3E82E355B81AF1');
        $this->addSql('ALTER TABLE ct_carte_grise DROP FOREIGN KEY FK_A447BE73346884A7');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A2346884A7');
        $this->addSql('ALTER TABLE ct_visite_visite_extra DROP FOREIGN KEY FK_497E418E5314CD4');
        $this->addSql('ALTER TABLE ct_visite_visite_extra DROP FOREIGN KEY FK_497E418E15D88434');
        $this->addSql('ALTER TABLE ct_visite_extra_tarif DROP FOREIGN KEY FK_E3F1985E15D88434');
        $this->addSql('ALTER TABLE ct_carte_grise DROP FOREIGN KEY FK_A447BE73C50880EA');
        $this->addSql('DROP TABLE ct_anomalie');
        $this->addSql('DROP TABLE ct_anomalie_type');
        $this->addSql('DROP TABLE ct_carosserie');
        $this->addSql('DROP TABLE ct_carte_grise');
        $this->addSql('DROP TABLE ct_centre');
        $this->addSql('DROP TABLE ct_const_av_ded');
        $this->addSql('DROP TABLE ct_const_av_deds_const_av_ded_caracs');
        $this->addSql('DROP TABLE ct_const_av_ded_carac');
        $this->addSql('DROP TABLE ct_const_av_ded_type');
        $this->addSql('DROP TABLE ct_droit_ptac');
        $this->addSql('DROP TABLE ct_droit_ptac_backup');
        $this->addSql('DROP TABLE ct_droit_ptac_bak');
        $this->addSql('DROP TABLE ct_genre');
        $this->addSql('DROP TABLE ct_genre_categorie');
        $this->addSql('DROP TABLE ct_genre_tarif');
        $this->addSql('DROP TABLE ct_historique');
        $this->addSql('DROP TABLE ct_marque');
        $this->addSql('DROP TABLE ct_motif');
        $this->addSql('DROP TABLE ct_motif_tarif');
        $this->addSql('DROP TABLE ct_proces_verbal');
        $this->addSql('DROP TABLE ct_province');
        $this->addSql('DROP TABLE ct_reception');
        $this->addSql('DROP TABLE ct_reception_backup');
        $this->addSql('DROP TABLE ct_role');
        $this->addSql('DROP TABLE ct_source_energie');
        $this->addSql('DROP TABLE ct_type_droit_ptac');
        $this->addSql('DROP TABLE ct_type_reception');
        $this->addSql('DROP TABLE ct_type_usage');
        $this->addSql('DROP TABLE ct_type_visite');
        $this->addSql('DROP TABLE ct_usage');
        $this->addSql('DROP TABLE ct_usage_tarif');
        $this->addSql('DROP TABLE ct_user');
        $this->addSql('DROP TABLE ct_utilisation');
        $this->addSql('DROP TABLE ct_vehicule');
        $this->addSql('DROP TABLE ct_visite');
        $this->addSql('DROP TABLE ct_visite_anomalie');
        $this->addSql('DROP TABLE ct_visite_buckup');
        $this->addSql('DROP TABLE ct_visite_extra');
        $this->addSql('DROP TABLE ct_visite_visite_extra');
        $this->addSql('DROP TABLE ct_visite_extra_tarif');
        $this->addSql('DROP TABLE ct_zone_deserte');
    }
}
