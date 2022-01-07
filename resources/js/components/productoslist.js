
function ProductosList({
  productos,
  addCarrito,

  clickSetOrderColumn,

  orderColumn,
  orderBy,
  counterListProductos,
  setCounterListProductos,
  tbodyproductosref,
  focusCtMain
}) {

  return (
    <>
      <table className="tabla-facturacion">
        <thead>
          <tr>
            <th className="cell2 pointer" 
            data-valor="codigo_proveedor" 
            onClick={clickSetOrderColumn}>Cod. 
              {orderColumn=="codigo_proveedor"?(<i className={orderBy=="desc"?"fa fa-arrow-up":"fa fa-arrow-down"}></i>):null}
            </th>
            <th className="cell4 pointer" 
            data-valor="descripcion" 
            onClick={clickSetOrderColumn}>Desc. 
              {orderColumn=="descripcion"?(<i className={orderBy=="desc"?"fa fa-arrow-up":"fa fa-arrow-down"}></i>):null}
            </th>
            <th className="cell1 pointer" 
            data-valor="cantidad" 
            onClick={clickSetOrderColumn}>Disp. 
              {orderColumn=="cantidad"?(<i className={orderBy=="desc"?"fa fa-arrow-up":"fa fa-arrow-down"}></i>):null}
            </th>
            <th className="cell1 pointer" 
            data-valor="unidad" 
            onClick={clickSetOrderColumn}>Unidad 
              {orderColumn=="unidad"?(<i className={orderBy=="desc"?"fa fa-arrow-up":"fa fa-arrow-down"}></i>):null}
            </th>
            <th className="cell2 pointer" 
            data-valor="precio" 
            onClick={clickSetOrderColumn}>Precio 
              {orderColumn=="precio"?(<i className={orderBy=="desc"?"fa fa-arrow-up":"fa fa-arrow-down"}></i>):null}
            </th>
          </tr>
        </thead>
        <tbody ref={tbodyproductosref}>
          {productos.map((e,i)=>
            <tr data-index={i} tabIndex="-1" className={(counterListProductos==i?"bg-select":null)+(' tr-producto')} key={e.id}>
              <td data-index={i} onClick={addCarrito} className="pointer cell3">{e.codigo_barras}</td>
              <td data-index={i} onClick={addCarrito} className='pointer text-left pl-5 cell3'>{e.descripcion}</td>
              <td className="cell1">
                <a href='#' className='formShowProductos btn btn-arabito btn-sm w-50'>{e.cantidad}</a>         
              </td>
              <td className="cell1">{e.unidad}</td>
              <td className="cell2">
                <div className='btn-group w-75'>
                    <button type="button" className='m-0 btn-sm btn btn-success text-light w-50'>{e.precio}</button>
                    <button type="button" className='m-0 btn-sm btn btn-secondary w-50'>Bs. {e.bs} </button>
                </div>
                <div className='btn-group w-75'>
                    <button type="button" className='m-0 btn-sm btn btn-secondary'>Cop. {e.cop}</button>
                </div>
              </td>
            </tr>
            )}
        </tbody>
      </table>

      <div className="table-phone">
        { 
          productos.length
          ? productos.map( (e,i) =>
            <div 
            key={e.id}
            data-index={i} onClick={addCarrito}
            className={(false?"bg-arabito-light":"bg-light")+" text-secondary card mb-3 pointer shadow"}>
              <div className="card-header flex-row justify-content-between">
                <div className="d-flex justify-content-between">
                  <div className="w-50">
                    <small className="fst-italic">{e.codigo_barras}</small><br/>
                    <small className="fst-italic">{e.codigo_proveedor}</small><br/>

                    
                  </div>
                  <div className="w-50 text-right">

                    <span className="h6 text-muted font-italic">Bs. {e.bs}</span>
                    <br/>
                    <span className="h6 text-muted font-italic">COP. {e.cop}</span>
                    <br/>
                    <span className="h3 text-success">{e.precio}</span>
                  </div>
                </div>
              </div>
              <div className="card-body d-flex justify-content-between">
                <div className="">
                  <span 
                  className="card-title "
                  ><b>{e.descripcion}</b></span>
                </div> 
                <p className="card-text p-1">
                  Ct. <b className="h3">{e.cantidad}</b>
                </p>
              </div>
            </div>
           )
          : <div className='h3 text-center text-dark mt-2'><i>¡Sin resultados!</i></div>
        }
      </div>
    </>
  )
}
export default ProductosList