<?php
namespace App;
class academic_area extends connect{
    private $queryPost = 'INSERT INTO academic_area(id, id_area, id_staff, id_position, id_journey) VALUES (:identificador, :fk_area, :fk_staff, :fk_posicion, :fk_journeys)';
    private $queryGetAll = 'SELECT academic_area.id AS "identificador",
    academic_area.id_area AS "fk_area",
    areas.name_area AS "fk_name_area",
    academic_area.id_staff AS "fk_staff",
    staff.first_name AS "fk_first_name",
    staff.first_surname AS "fk_first_surname",
    academic_area.id_position AS "fk_posicion",
    position.name_position AS "fk_name_position",
    academic_area.id_journey AS "fk_journeys",
    journey.name_journey AS "fk_name_journey"
    FROM academic_area
    INNER JOIN areas ON academic_area.id_area = areas.id
    INNER JOIN staff ON academic_area.id_staff = staff.id
    INNER JOIN position ON academic_area.id_position = position.id
    INNER JOIN journey ON academic_area.id_journey = journey.id';
    private $queryGet = 'SELECT academic_area.id AS "identificador",
    academic_area.id_area AS "fk_area",
    areas.name_area AS "fk_name_area",
    academic_area.id_staff AS "fk_staff",
    staff.first_name AS "fk_first_name",
    staff.first_surname AS "fk_first_surname",
    academic_area.id_position AS "fk_posicion",
    position.name_position AS "fk_name_position",
    academic_area.id_journey AS "fk_journeys",
    journey.name_journey AS "fk_name_journey"
    FROM academic_area
    INNER JOIN areas ON academic_area.id_area = areas.id
    INNER JOIN staff ON academic_area.id_staff = staff.id
    INNER JOIN position ON academic_area.id_position = position.id
    INNER JOIN journey ON academic_area.id_journey = journey.id WHERE academic_area.id=:identificador';
    private $queryUpdate = 'UPDATE academic_area SET id_area = :fk_area, id_staff = :fk_staff, id_position = :fk_posicion, id_journey = :fk_journeys WHERE id = :identificador';
    private $queryDelete = 'DELETE FROM academic_area WHERE id = :identificador';
    private $message;
    use getInstance;

    function __construct(private $id=1, private $id_area=1, private $id_staff=1, private $id_position=1, private $id_journey=1 ){
        parent::__construct();
    }

    public function post_academic_area(){
        try{
            $res = $this->conexion->prepare($this->queryPost);
            $res->bindValue("identificador", $this->id);
            $res->bindValue("fk_area", $this->id_area);
            $res->bindValue("fk_staff", $this->id_staff);
            $res->bindValue("fk_posicion", $this->id_position);
            $res->bindValue("fk_journeys", $this->id_journey);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message"=>"inserted Data"];
        } catch (\PDOException $e){
            $this->message = ["Code" => $e->getCode(), "Message"=> $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
     
    }
    public function getAll_academic_area(){
        try{
            $res = $this->conexion->prepare($this->queryGetAll);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(\PDO::FETCH_ASSOC)];
        }   catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        }   finally {
            print_r($this->message);
        }
    }
    public function get_academic_area($id){
        try{
            $res = $this->conexion->prepare($this->queryGet);
            $res->bindParam("identificador", $id);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => $res->fetch(\PDO::FETCH_ASSOC)];
        }   catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        }   finally {
            print_r($this->message);
        }
    }
    public function update_academic_area(){
        try{
            $res = $this->conexion->prepare($this->queryUpdate);
            $res->bindValue("identificador", $this->id);
            $res->bindValue("fk_area", $this->id_area);
            $res->bindValue("fk_staff", $this->id_staff);
            $res->bindValue("fk_posicion", $this->id_position);
            $res->bindValue("fk_journeys", $this->id_journey);
            $res->execute();
 
            if ($res->rowCount() > 0){
                $this->message = ["Code" => 200, "Message" => "Data updated"];
            }
        } catch (\PDOException $e){
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function delete_academic_area(){
        try{
            $res = $this->conexion->prepare($this->queryDelete);
            $res->bindValue("identificador", $this->id);
            $res-> execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e){
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}



?>
