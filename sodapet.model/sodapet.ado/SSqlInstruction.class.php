<?php
/*
 * classe SSqlInstruction
 * Esta classe provê os métodos em comum entre todas instruções
 * SQL (SELECT, INSERT, DELETE e UPDATE)
 */
abstract class SSqlInstruction
{
    protected $sql;		     // armazena a instrução SQL
    protected $criteria;	 // armazena o objeto critério
    protected $entity;
    
    /*
     * método setEntity()
     * define o nome da entidade (tabela) manipulada pela instrução SQL
     * @param $entity = tabela
     */
    final public function setEntity($entity)
    {
        $this->entity = $entity;
    }
    
    /*
     * método getEntity()
     * retorna o nome da entidade (tabela)
     */
    final public function getEntity()
    {
        return $this->entity;
    }
    
    /*
     * método setCriteria()
     * Define um critério de seleção dos dados através da composição de um objeto
     * do tipo SCriteria, que oferece uma interface para definição de critérios
     * @param $criteria = objeto do tipo SCriteria
     */
    public function setCriteria(SCriteria $criteria)
    {
        $this->criteria = $criteria;
    }
    
    /*
     * método getInstruction()
     * declarando-o como <abstract> obrigamos sua declaração nas classes filhas,
     * uma vez que seu comportamento será distinto em cada uma delas, configurando polimorfismo.
     */
    abstract function getInstruction();
}
?>