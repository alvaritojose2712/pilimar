export default function ModalMovimientos({
  getMovimientos,
  setShowModalMovimientos,
  showModalMovimientos,

  setBuscarDevolucion,
  buscarDevolucion,

  setTipoMovMovimientos,
  tipoMovMovimientos,
  
  setTipoCatMovimientos,
  tipoCatMovimientos,

  productosDevulucionSelect,
  setDevolucion,

  idMovSelect,
  setIdMovSelect,

  movimientos,

  delMov,
  movimientosList,
  setFechaMovimientos,
  fechaMovimientos,


  setToggleAddPersona,
  getPersona,
  personas,
  setPersonas,
  setPersonaFastDevolucion,
  clienteInpidentificacion,
  setclienteInpidentificacion,
  clienteInpnombre,
  setclienteInpnombre,
  clienteInptelefono,
  setclienteInptelefono,
  clienteInpdireccion,
  setclienteInpdireccion,

  debito,
  efectivo,
  transferencia,
  biopago,
  credito,
  vuelto,
  setVuelto,
  getDebito,
  getEfectivo,
  getTransferencia,
  getBio,
  getCredito,
  syncPago,
  debitoBs,
  editable,
  vuelto_entregado,
  entregarVuelto,
  number,
  addRefPago,
}) {


  const retCat = cat => {
    switch(cat){
      case '1':
        return "Garantía"
      break;

      case '2':
        return "Cambio"
      break;
    }
  }
  
  
  return (
    <>
      <section className="modal-custom shadow"> 
        <div className="text-danger" onClick={()=>setShowModalMovimientos(!showModalMovimientos)}><span className="closeModal">&#10006;</span></div>
        <div className="modal-content">
          

          <div className="container-fluid">
            <div className="row">
              <div className="col-5">
                <h4>Devoluciones / Garantías</h4>

                <input type="text" className="form-control" placeholder="Buscar..." onChange={e=>setBuscarDevolucion(e.target.value)} value={buscarDevolucion}/>
                {!buscarDevolucion?
                <table className="table">
                  <tbody>
                    {productosDevulucionSelect.length?productosDevulucionSelect.map(e=>
                      <tr key={e.id} data-id={e.id} className="hover">
                        <td>{e.codigo_proveedor}</td>
                        <td>{e.descripcion}</td>
                        <td>Ct. {e.cantidad}</td>
                        <td>P/U. {e.precio}</td>
                        <th>
                          <button className="btn btn-circle text-white btn-success btn-sm me-1" onClick={()=>setDevolucion(1, e.id)} title="Entrada" ><i className="fa fa-arrow-down"></i></button>
                          <button className="btn btn-circle text-white btn-danger btn-sm me-1" onClick={()=>setDevolucion(0, e.id)} title="Salida"><i className="fa fa-arrow-up"></i></button>
                        </th>
                      </tr>
                    ):null}
                  </tbody>
                </table>:null}
              </div>
              <div className="col">
                <div className="container-fluid">
                  <div className="row">
                    <div className="col">
                      <h5>Agregar Cliente</h5>
                      <div>
                        <input type="text" className="form-control" placeholder="Buscar..." onChange={(val)=>getPersona(val.target.value)}/>
                      </div>

                      <table className="table table-bordered tabla_datos">
                        <thead>
                          <tr>
                            <th>CÉDULA</th>
                            <th>NOMBRE Y APELLIDO</th>
                          </tr>
                        </thead>
                        <tbody>
                          {personas.length?personas.map((e,i)=>
                            <tr tabIndex="-1" className={('tr-producto')} key={e.id} onClick={setPersonas} data-index={e.id}>
                              <td>{e.identificacion}</td>
                              <td data-index={i}>{e.nombre}</td>
                            </tr>
                            ):null}

                          {!personas.length?<tr>
                            <td colSpan="2">
                              <form onSubmit={setPersonaFastDevolucion} className="w-50 m-3">
                                <div className="form-group">
                                    <label htmlFor="">
                                      C.I./RIF
                                    </label> 
                                      <input type="text" 
                                      value={clienteInpidentificacion} 
                                      onChange={e=>setclienteInpidentificacion(e.target.value)} 
                                      className="form-control"/>
                                  </div>

                                  <div className="form-group">
                                    <label htmlFor="">
                                      Nombres y Apellidos
                                    </label> 
                                      <input type="text" 
                                      value={clienteInpnombre} 
                                      onChange={e=>setclienteInpnombre(e.target.value)} 
                                      className="form-control"/>
                                  </div>
                                  <div className="form-group">
                                    <label htmlFor="">
                                      Teléfono
                                    </label> 
                                      <input type="text" 
                                      value={clienteInptelefono} 
                                      onChange={e=>setclienteInptelefono(e.target.value)} 
                                      className="form-control"/>
                                  </div>
                                  <div className="form-group">
                                    <label htmlFor="">
                                      Dirección
                                    </label> 
                                      <input type="text" 
                                      value={clienteInpdireccion} 
                                      onChange={e=>setclienteInpdireccion(e.target.value)} 
                                      className="form-control"/>
                                  </div>
                                  <div className="form-group">
                                    <button className="btn btn-outline-success btn-block" type="submit">Guardar</button>
                                  </div>
                              </form>
                            </td>
                          </tr>:null}
                        </tbody>
                      </table>  

                    </div>
                  </div>
                  <div className="row">
                    <div className="col">
                      <Metodospago
                        debito={debito}
                        efectivo={efectivo}
                        transferencia={transferencia}
                        biopago={biopago}
                        credito={credito}
                        vuelto={vuelto}
                        setVuelto={setVuelto}
                        getDebito={getDebito}
                        getEfectivo={getEfectivo}
                        getTransferencia={getTransferencia}
                        getBio={getBio}
                        getCredito={getCredito}
                        syncPago={syncPago}
                        debitoBs={debitoBs}
                        editable={editable}
                        vuelto_entregado={vuelto_entregado}
                        entregarVuelto={entregarVuelto}
                        number={number}
                        addRefPago={addRefPago}
                        
                        vervuelto={false}
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div className="overlay"></div>
    </>

    
  )
}


/* export default function ModalMovimientos({
  getMovimientos,
  setShowModalMovimientos,
  showModalMovimientos,

  setBuscarDevolucion,
  buscarDevolucion,

  setTipoMovMovimientos,
  tipoMovMovimientos,
  
  setTipoCatMovimientos,
  tipoCatMovimientos,

  productosDevulucionSelect,
  setDevolucion,

  idMovSelect,
  setIdMovSelect,

  movimientos,

  delMov,
  movimientosList,
  setFechaMovimientos,
  fechaMovimientos,
}) {

  const retTipoMov = (type) => (
    <table className="table">
      
      <tbody>
        {productosDevulucionSelect?.length?productosDevulucionSelect.map(e=>
          <tr key={e.id} onClick={setDevolucion} data-id={e.id} data-type={type} className="hover">
            <td>{e.codigo_proveedor}</td>
            <td>{e.descripcion}</td>
            <td>Ct. {e.cantidad}</td>
            <td>P/U. {e.precio}</td>
          </tr>
        ):null}
      </tbody>
    
    </table>
         
  )
  const retCat = cat => {
    switch(cat){
      case '1':
        return "Garantía"
      break;

      case '2':
        return "Cambio"
      break;
    }
  }
  const retTipoSubMov = (items,tipo) =>(
      <>
        <table className="table table-sm">
          <thead>
            <tr>
              <th>Cat.</th>
              <th>Prod.</th>
              <th>Precio</th>
              <th>Ct.</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            {items.filter(e=>e.tipo==tipo).map(ee=>
              <tr key={ee.id}>
                <td>{retCat(ee.categoria)}</td>
                <th>{ee.producto.codigo_proveedor} {ee.producto.descripcion}</th>
                <td>{ee.producto.precio}</td>
                <td>{ee.cantidad}</td>
                <td className="">{ee.total}</td>
                <td><i className="fa fa-times text-danger" data-id={ee.id} onClick={delMov}></i></td>
              </tr>)
            }
          </tbody>
        </table>
          
      </>
  )
  
  return (
    <>
      <section className="modal-custom"> 
        <div className="text-danger" onClick={()=>setShowModalMovimientos(!showModalMovimientos)}><span className="closeModal">&#10006;</span></div>
        <div className="modal-content">
          

          <div className="container-fluid">
            <div className="row">
              <div className="col-2">
                <h4>Devoluciones <button className="btn btn-success" onClick={()=>setIdMovSelect("nuevo")}>Nuevo</button></h4>
                <input type="text" className="form-control mb-1" placeholder="Buscar..." onChange={e=>getMovimientos(e.target.value)}/>
                <div className="list-items">
                  {movimientos.length?movimientos.map(e=>
                    <div className={("card-pedidos pointer ")+(e.id==idMovSelect?"bg-sinapsis-light":null)} key={e.id} onClick={()=>setIdMovSelect(e.id)}>Mov. {e.id}</div>

                  ):null}
                </div>
              </div>
              <div className="col">
                <div className="d-flex justify-content-between">
                  <div className="h1">Seleccionado: Mov. {idMovSelect}</div>

                  {
                    movimientos.length&&movimientos.filter(e=>e.id==idMovSelect).length?
                      movimientos.filter(e=>e.id==idMovSelect).map(e=>
                        <div className="h1" key={e.id}>Diff. {e.diff}</div>
                      )
                    :null
                  }
                  
                </div>

                <div className="container-fluid">
                  <div className="row">
                    <div className="col">
                      <div className="header text-center bg-success-super">
                        <h1 onClick={()=>setTipoMovMovimientos(1)}><span className="pointer">Entrada</span> {tipoMovMovimientos==1?
                          <input type="text" className="form-control" placeholder="Buscar..." 
                        onChange={e=>setBuscarDevolucion(e.target.value)}
                        value={buscarDevolucion}
                        />:null}
                        </h1>
                        {buscarDevolucion==""?
                          movimientos.length&&movimientos.filter(e=>e.id==idMovSelect).length?
                            movimientos.filter(e=>e.id==idMovSelect).map(e=>
                              <div key={e.id}>
                                {retTipoSubMov(e.items,1)}
                                <div className="h3">Tot. {e.tot1}</div>

                              </div>
                            )
                          :null
                        :
                          tipoMovMovimientos==1?retTipoMov(1):null
                        }
                      </div>
                    </div>
                  </div>

                  <div className="row">
                    <div className="col">
                      <div className="header text-center bg-danger-super">
                        <h1 onClick={()=>setTipoMovMovimientos(0)}><span className="pointer">Salida</span> {tipoMovMovimientos==0?<input type="text" className="form-control" placeholder="Buscar..." 
                        onChange={e=>setBuscarDevolucion(e.target.value)}
                        value={buscarDevolucion}
                        />
                        :null}
                        </h1>
                        
                        {buscarDevolucion==""?
                          movimientos.length&&movimientos.filter(e=>e.id==idMovSelect).length?
                            movimientos.filter(e=>e.id==idMovSelect).map(e=>
                              <div key={e.id}>
                                {retTipoSubMov(e.items,0)}
                                <div className="h3">Tot. {e.tot0}</div>
                              </div>
                            )
                          :null
                        :
                          tipoMovMovimientos==0?retTipoMov(0):null
                        }
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div className="overlay"></div>
    </>

    
  )
}
 */