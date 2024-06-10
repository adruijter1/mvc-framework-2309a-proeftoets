<?php

class Zangeres
{
    private $db;

    public function __construct()
    {
        /**
         * Maak een nieuw database object die verbinding maakt met de 
         * MySQL server
         */
        $this->db = new Database();
    }

    /**
     * Haal alle records op uit de Country-tabel
     */
    public function getZangeressen()
    {
        try {
            /**
             * Maak een sql-query die de gewenste informatie opvraagt uit de database
             */
            $sql = 'SELECT Id
                          ,Naam
                          ,NettoWaarde
                          ,Land
                          ,Mobiel
                          ,Leeftijd
                    FROM   Zangeres
                    ORDER BY Leeftijd DESC';

            /**
             * Prepare de query voor het PDO object
             */
            $this->db->query($sql);

            /**
             * Geef de opgehaalde informatie terug aan de controller
             */
            return $this->db->resultSet();
            
        } catch (Exception $e) {
            // Behandel de uitzondering hier, bijvoorbeeld loggen of een foutmelding weergeven
            echo 'Er is een fout opgetreden: ' . $e->getMessage();
        }
    }

    public function deleteZangeres($zangeresId)
    {
        $sql = "DELETE FROM Zangeres WHERE Id = :zangeresId";

        $this->db->query($sql);

        $this->db->bind(':zangeresId', $zangeresId, PDO::PARAM_INT);

        return $this->db->execute();
    }
    

}