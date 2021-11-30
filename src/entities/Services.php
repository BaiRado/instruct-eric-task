<?php
class Services
{
    // database properties
    private $connection;
    private $table = 'services';

    // service properties
    public $ref;
    public $centre;
    public $service;
    public $country;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // get services
    public function read()
    {
        // create query
        $query = '
                SELECT 
                    ref, 
                    centre, 
                    service, 
                    country
                FROM 
                    ' . $this->table . '
                ORDER BY 
                    country DESC
            ';

        // prepare statement
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // get service by country
    public function read_by_country()
    {
        // create query
        $query = '
                SELECT
                    ref, 
                    centre, 
                    service, 
                    country
                FROM 
                    ' . $this->table . '
                WHERE 
                    country = :county_code
                ORDER BY
                    centre DESC
            ';

        // prepare statement
        $stmt = $this->connection->prepare($query);

        // bind country code
        $stmt->bindParam(':county_code', $this->country);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create service
    public function create()
    {
        // create query
        $query = '
                INSERT INTO 
                    ' . $this->table . ' 
                SET
                    ref = :ref,
                    centre = :centre,
                    service = :service,
                    country = :country
            ';

        // prepare statement
        $stmt = $this->connection->prepare($query);

        // clean data
        $this->ref = htmlspecialchars(strip_tags($this->ref));
        $this->centre = htmlspecialchars(strip_tags($this->centre));
        $this->service = htmlspecialchars(strip_tags($this->service));
        $this->country = htmlspecialchars(strip_tags($this->country));

        // bind data
        $stmt->bindParam(':ref', $this->ref);
        $stmt->bindParam(':centre', $this->centre);
        $stmt->bindParam(':service', $this->service);
        $stmt->bindParam(':country', $this->country);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        // print error
        printf('Error: %s.', $stmt->error);

        return false;
    }

    // update service
    public function update()
    {
        // create query
        $query = '
                UPDATE 
                    ' . $this->table . ' 
                SET
                    centre = :centre,
                    service = :service,
                    country = :country
                WHERE
                    ref = :ref
            ';

        // prepare statement
        $stmt = $this->connection->prepare($query);

        // clean data
        $this->ref = htmlspecialchars(strip_tags($this->ref));
        $this->centre = htmlspecialchars(strip_tags($this->centre));
        $this->service = htmlspecialchars(strip_tags($this->service));
        $this->country = htmlspecialchars(strip_tags($this->country));

        // bind data
        $stmt->bindParam(':ref', $this->ref);
        $stmt->bindParam(':centre', $this->centre);
        $stmt->bindParam(':service', $this->service);
        $stmt->bindParam(':country', $this->country);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        // print error
        printf('Error: %s.', $stmt->error);

        return false;
    }

    // delete service
    public function delete()
    {
        // create query
        $query = '
                DELETE FROM 
                    ' . $this->table . ' 
                WHERE
                    ref = :ref
            ';

        // prepare statement
        $stmt = $this->connection->prepare($query);

        // clean data
        $this->ref = htmlspecialchars(strip_tags($this->ref));

        // bind data
        $stmt->bindParam(':ref', $this->ref);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        // print error
        printf('Error: %s.', $stmt->error);

        return false;
    }
}
