<?php
/*
 * classe SExpression
 * classe abstrata para gerenciar expressões
 */
abstract class SExpression
{
    // operadores lógicos
    const AND_OPERATOR = 'AND ';
    const OR_OPERATOR = 'OR ';
    
    // marca método dump como obrigatório
    abstract public function dump();
}
?>
