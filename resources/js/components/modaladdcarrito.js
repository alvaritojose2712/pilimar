

function ModalAddCarrito({inputCantidadCarritoref,producto,pedidoList,setSelectItem,addCarritoRequest,cantidad,numero_factura,setCantidad,setNumero_factura}) {

  return (
    <>
      <section className="modal-custom"> 
        <div className="text-danger" onClick={setSelectItem}><span className="closeModal">&#10006;</span></div>
        <div className="modal-content modal-cantidad">
         <div className="d-flex justify-content-between">
          <div>
            <h5>{producto.codigo_proveedor}</h5>
            <h4>{producto.descripcion}</h4>
          </div>
          <h5 className="text-success">${producto.precio}</h5>
          
         </div>
          <form onSubmit={e=>e.preventDefault()} className="d-flex justify-content-center flex-column p-3">
            
            <input type="number" ref={inputCantidadCarritoref} className="cantidad numero mb-3" placeholder="Cantidad" onChange={(e)=>setCantidad(e.target.value)} value={cantidad}/>
            <div className="input-group mb-3">
              <div className="input-group-prepend">
                <span className="input-group-text">Pedido #</span>
              </div>
              <select className="form-control" onChange={(e)=>setNumero_factura(e.target.value)} value={numero_factura}>
                {pedidoList.map((e,i)=>
                  <option value={e.id} key={e.id}>{e.id}</option>
                )}
                  <option value='nuevo'>Nuevo Pedido</option>
              </select>
            </div>
            <div className="btn-group">
              <button className="btn btn-arabito agregar_carrito" type="button" onClick={addCarritoRequest} data-type="agregar">Agregar (ctrl+enter)</button>
              <button className="btn btn-outline-success" type="button" onClick={addCarritoRequest} data-type="agregar_procesar">Agregar y procesar (enter)</button>
              
            </div>
          </form>

        </div>
      </section>
      <div className="overlay"></div>
    </>

    
  )
}
export default ModalAddCarrito