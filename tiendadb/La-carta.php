<?php
// Inicia sesión
session_start();

class Cart {
    // Contenidos del carrito
    protected $cart_contents = array();
    
    public function __construct(){
        // Obtiene el array del carrito de la sesión
        $this->cart_contents = !empty($_SESSION['cart_contents']) ? $_SESSION['cart_contents'] : NULL;
        if ($this->cart_contents === NULL){
            // Establece algunos valores base
            $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
        }
    }
    
    /**
     * Contenidos del carrito: Devuelve el array completo del carrito
     * @param	bool
     * @return	array
     */
    public function contents(){
        // Reorganiza para que el más reciente esté primero
        $cart = array_reverse($this->cart_contents);

        // Elimina estos valores para que no causen problemas al mostrar la tabla del carrito
        unset($cart['total_items']);
        unset($cart['cart_total']);

        return $cart;
    }
    
    /**
     * Obtiene un artículo del carrito: Devuelve los detalles de un artículo específico del carrito
     * @param	string	$row_id
     * @return	array
     */
    public function get_item($row_id){
        return (in_array($row_id, array('total_items', 'cart_total'), TRUE) OR !isset($this->cart_contents[$row_id]))
            ? FALSE
            : $this->cart_contents[$row_id];
    }
    
    /**
     * Total de artículos: Devuelve el recuento total de artículos
     * @return	int
     */
    public function total_items(){
        return $this->cart_contents['total_items'];
    }
    
    /**
     * Total del carrito: Devuelve el precio total
     * @return	int
     */
    public function total(){
        return $this->cart_contents['cart_total'];
    }
    
    /**
     * Inserta artículos en el carrito y guardarlo en la sesión
     * @param	array
     * @return	bool
     */
    public function insert($item = array()){
        // Verifica que el elemento sea un array y no esté vacío
        if(!is_array($item) OR count($item) === 0){
            return FALSE;
        } else {
            // Verifica que el elemento tenga los índices requeridos
            if(!isset($item['id'], $item['name'], $item['price'], $item['qty'])){
                return FALSE;
            } else {
                // Prepara la cantidad
                $item['qty'] = (float) $item['qty'];
                if($item['qty'] == 0){
                    return FALSE;
                }
                // Prepara el precio
                $item['price'] = (float) $item['price'];
                // Crea un identificador único para el artículo
                $rowid = md5($item['id']);
                // Obtene la cantidad si ya está en el carrito y sumarla
                $old_qty = isset($this->cart_contents[$rowid]['qty']) ? (int) $this->cart_contents[$rowid]['qty'] : 0;
                // Recrea la entrada con el identificador único y la cantidad actualizada
                $item['rowid'] = $rowid;
                $item['qty'] += $old_qty;
                $this->cart_contents[$rowid] = $item;
                
                // Guarda el artículo en el carrito
                if($this->save_cart()){
                    return isset($rowid) ? $rowid : TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }
    
    /**
     * Actualiza el carrito
     * @param	array
     * @return	bool
     */
    public function update($item = array()){
        // Verifica que el elemento sea un array y no esté vacío
        if (!is_array($item) OR count($item) === 0){
            return FALSE;
        } else {
            // Verifica que el elemento tenga el índice 'rowid' y que exista en el carrito
            if (!isset($item['rowid'], $this->cart_contents[$item['rowid']])){
                return FALSE;
            } else {
                // Prepara la cantidad
                if(isset($item['qty'])){
                    $item['qty'] = (float) $item['qty'];
                    // Elimina el artículo del carrito si la cantidad es cero
                    if ($item['qty'] == 0){
                        unset($this->cart_contents[$item['rowid']]);
                        return TRUE;
                    }
                }
                
                // Encuentra las claves actualizables
                $keys = array_intersect(array_keys($this->cart_contents[$item['rowid']]), array_keys($item));
                // Prepara el precio
                if(isset($item['price'])){
                    $item['price'] = (float) $item['price'];
                }
                // El ID del producto y el nombre no deberían cambiarse
                foreach(array_diff($keys, array('id', 'name')) as $key){
                    $this->cart_contents[$item['rowid']][$key] = $item[$key];
                }
                // Guarda los datos del carrito
                $this->save_cart();
                return TRUE;
            }
        }
    }
    
    /**
     * Guarda el array del carrito en la sesión
     * @return	bool
     */
    protected function save_cart(){
        // Inicializa los totales
        $this->cart_contents['total_items'] = $this->cart_contents['cart_total'] = 0;
        // Recorre los artículos del carrito
        foreach ($this->cart_contents as $key => $val){
            if(!is_array($val) OR !isset($val['price'], $val['qty'])){
                continue;
            }
     
            // Calcula el total del carrito y el total de artículos
            $this->cart_contents['cart_total'] += ($val['price'] * $val['qty']);
            $this->cart_contents['total_items'] += $val['qty'];
            // Calcula el subtotal para cada artículo
            $this->cart_contents[$key]['subtotal'] = ($this->cart_contents[$key]['price'] * $this->cart_contents[$key]['qty']);
        }
        
        // Si el carrito está vacío, eliminarlo de la sesión
        if(count($this->cart_contents) <= 2){
            unset($_SESSION['cart_contents']);
            return FALSE;
        } else {
            // Guarda los contenidos del carrito en la sesión
            $_SESSION['cart_contents'] = $this->cart_contents;
            return TRUE;
        }
    }
    
    /**
     * Elimina un artículo del carrito
     * @param	int
     * @return	bool
     */
    public function remove($row_id){
        // Elimina y guarda
        unset($this->cart_contents[$row_id]);
        $this->save_cart();
        return TRUE;
    }
     
    /**
     * Destruye el carrito: Vaciar el carrito y destruir la sesión
     * @return	void
     */
    public function destroy(){
        // Restablece los contenidos del carrito
        $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
        // Elimina el carrito de la sesión
        unset($_SESSION['cart_contents']);
    }
}
?>
