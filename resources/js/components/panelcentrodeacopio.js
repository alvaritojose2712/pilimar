export default function Panelcentrodeacopio({
    getSucursales,
    sucursalesCentral,
    setselectSucursalCentral,
    selectSucursalCentral,

    getInventarioSucursalFromCentral,
    inventariSucursalFromCentral,

    categorias,
    proveedoresList,
    changeInventarioFromSucursalCentral,
    setCambiosInventarioSucursal,
    number,
}) {
    const type = type => {
        return !type || type === "delete" ? true : false
    }
    return (
        <div className="container">
            <div className="row">
                <div className="col-2">

                    <button className="btn btn-outline-success w-100 mb-1" onClick={getSucursales}>Buscar Sucursales</button>

                    <ul className="list-group">
                        {sucursalesCentral ? sucursalesCentral.length?
                            sucursalesCentral.map(e=>
                                <li onClick={()=>setselectSucursalCentral(e.id)} 
                                className={(e.id == selectSucursalCentral?"active":null)+(" list-group-item")} 
                                    key={e.id}>{e.codigo} - {e.nombre}</li>
                            )
                        :null:null}
                    </ul>
                </div>
                <div className="col">
                    {selectSucursalCentral!==null?
                        <>
                            <button className="btn btn-outline-success mb-1" onClick={getInventarioSucursalFromCentral}>Traer Inventario</button>
                            <button className="btn btn-outline-success mb-1" onClick={setCambiosInventarioSucursal}>Exportar Inventario</button>
                            

                            <form onSubmit={e => e.preventDefault()}>
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th className="cell05 pointer"><span>ID / ID SUCURSAL</span></th>
                                            <th className="cell1 pointer"><span>C. Alterno</span></th>
                                            <th className="cell1 pointer"><span>C. Barras</span></th>
                                            <th className="cell05 pointer"><span>Unidad</span></th>
                                            <th className="cell2 pointer"><span>Descripción</span></th>
                                            <th className="cell05 pointer"><span>Ct.</span></th>
                                            <th className="cell1 pointer"><span>Base</span></th>
                                            <th className="cell15 pointer">
                                                <span>Venta </span>
                                            </th>
                                            <th className="cell15 pointer" >
                                                <span>
                                                    Categoría
                                                </span>
                                               
                                                <br />
                                                <span>
                                                    Preveedor
                                                </span>
                                               
                                            </th>
                                            <th className="cell05 pointer"><span>IVA</span></th>
                                            <th className="cell1"></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {inventariSucursalFromCentral.length ? inventariSucursalFromCentral.map((e, i) =>
                                            <tr key={i} className={(e.check?"bg-success-light":"bg-danger-light")+(" pointer")} onDoubleClick={() => changeInventarioFromSucursalCentral(null, i, e.id, "update")}>
                                                <td className="cell05">
                                                    {e.id} / {e.id_pro_sucursal}
                                                </td>
                                                {type(e.type) ?
                                                    <>
                                                        <td className="cell1">{e.codigo_proveedor}</td>
                                                        <td className="cell1">{e.codigo_barras}</td>
                                                        <td className="cell05">{e.unidad}</td>
                                                        <td className="cell2">{e.descripcion}</td>
                                                        <th className="cell05">{e.cantidad}
                                                        </th>
                                                        <td className="cell1">{e.precio_base}</td>
                                                        <td className="cell15 text-success">
                                                            {e.precio}
                                                            
                                                        </td>
                                                        <td className="cell15">{e.categoria.descripcion} <br /> {e.proveedor.descripcion}</td>
                                                        <td className="cell05">{e.iva}</td>
                                                    </>

                                                    :
                                                    <>
                                                        <td className="cell1">
                                                            <input type="text"
                                                                disabled={type(e.type)} className="form-control form-control-sm"
                                                                value={!e.codigo_proveedor ? "" : e.codigo_proveedor}
                                                                onChange={e => changeInventarioFromSucursalCentral((e.target.value), i, e.id, "changeInput", "codigo_proveedor")}
                                                                placeholder="codigo_proveedor..." />

                                                        </td>
                                                        <td className="cell1">
                                                            <input type="text"
                                                                required={true}
                                                                disabled={type(e.type)} className={("form-control form-control-sm ") + (!e.codigo_barras ? "invalid" : null)}
                                                                value={!e.codigo_barras ? "" : e.codigo_barras}
                                                                onChange={e => changeInventarioFromSucursalCentral((e.target.value), i, e.id, "changeInput", "codigo_barras")}
                                                                placeholder="codigo_barras..." />

                                                        </td>
                                                        <td className="cell05">
                                                            <select
                                                                disabled={type(e.type)}
                                                                className={("form-control form-control-sm ") + (!e.unidad ? "invalid" : null)}
                                                                value={!e.unidad ? "" : e.unidad}
                                                                onChange={e => changeInventarioFromSucursalCentral((e.target.value), i, e.id, "changeInput", "unidad")}
                                                            >
                                                                <option value="">--Select--</option>
                                                                <option value="UND">UND</option>
                                                                <option value="PAR">PAR</option>
                                                                <option value="JUEGO">JUEGO</option>
                                                                <option value="PQT">PQT</option>
                                                                <option value="MTR">MTR</option>
                                                                <option value="KG">KG</option>
                                                                <option value="GRS">GRS</option>
                                                                <option value="LTR">LTR</option>
                                                                <option value="ML">ML</option>
                                                            </select>
                                                        </td>
                                                        <td className="cell2">
                                                            <textarea type="text"
                                                                required={true}
                                                                disabled={type(e.type)} className={("form-control form-control-sm ") + (!e.descripcion ? "invalid" : null)}
                                                                value={!e.descripcion ? "" : e.descripcion}
                                                                onChange={e => changeInventarioFromSucursalCentral((e.target.value.replace("\n", "")), i, e.id, "changeInput", "descripcion")}
                                                                placeholder="descripcion..."></textarea>

                                                        </td>
                                                        <td className="cell05">
                                                            <input type="text"
                                                                required={true}
                                                                disabled={type(e.type)} className={("form-control form-control-sm ") + (!e.cantidad ? "invalid" : null)}
                                                                value={!e.cantidad ? "" : e.cantidad}
                                                                onChange={e => changeInventarioFromSucursalCentral(number(e.target.value), i, e.id, "changeInput", "cantidad")}
                                                                placeholder="cantidad..." />

                                                        </td>
                                                        <td className="cell1">
                                                            <input type="text"
                                                                required={true}
                                                                disabled={type(e.type)} className={("form-control form-control-sm ") + (!e.precio_base ? "invalid" : null)}
                                                                value={!e.precio_base ? "" : e.precio_base}
                                                                onChange={e => changeInventarioFromSucursalCentral(number(e.target.value), i, e.id, "changeInput", "precio_base")}
                                                                placeholder="Base..." />



                                                        </td>
                                                        <td className="cell15">
                                                            <div className="input-group">
                                                                <input type="text"
                                                                    required={true}
                                                                    disabled={type(e.type)} className={("form-control form-control-sm ") + (!e.precio ? "invalid" : null)}
                                                                    value={!e.precio ? "" : e.precio}
                                                                    onChange={e => changeInventarioFromSucursalCentral(number(e.target.value), i, e.id, "changeInput", "precio")}
                                                                    placeholder="Venta..." />
                                                                <span className="btn btn-sm" onClick={() => setporcenganancia("list", e.precio_base, (precio) => {
                                                                    changeInventarioFromSucursalCentral(precio, i, e.id, "changeInput", "precio")
                                                                })}>%</span>
                                                            </div>

                                                        </td>
                                                        <td className="cell15">
                                                            <select
                                                                required={true}
                                                                disabled={type(e.type)}
                                                                className={("form-control form-control-sm ") + (!e.id_categoria ? "invalid" : null)}
                                                                value={!e.id_categoria ? "" : e.id_categoria}
                                                                onChange={e => changeInventarioFromSucursalCentral((e.target.value), i, e.id, "changeInput", "id_categoria")}
                                                            >
                                                                <option value="">--Select--</option>
                                                                {categorias.map(e => <option value={e.id} key={e.id}>{e.descripcion}</option>)}

                                                            </select>
                                                            <br />
                                                            <select
                                                                required={true}
                                                                disabled={type(e.type)}
                                                                className={("form-control form-control-sm ") + (!e.id_proveedor ? "invalid" : null)}
                                                                value={!e.id_proveedor ? "" : e.id_proveedor}
                                                                onChange={e => changeInventarioFromSucursalCentral((e.target.value), i, e.id, "changeInput", "id_proveedor")}
                                                            >
                                                                <option value="">--Select--</option>
                                                                {proveedoresList.map(e => <option value={e.id} key={e.id}>{e.descripcion}</option>)}

                                                            </select>
                                                        </td>
                                                        <td className="cell05">
                                                            <input type="text"
                                                                disabled={type(e.type)} className="form-control form-control-sm"
                                                                value={!e.iva ? "" : e.iva}
                                                                onChange={e => changeInventarioFromSucursalCentral(number(e.target.value, 2), i, e.id, "changeInput", "iva")}
                                                                placeholder="iva..." />

                                                        </td>
                                                    </>
                                                }
                                                <td className="cell1">
                                                    <div className='d-flex justify-content-between'>
                                                        {!e.type ?
                                                            <>
                                                                <span className="btn-sm btn btn-danger" onClick={() => changeInventarioFromSucursalCentral(null, i, e.id, "delMode")}><i className="fa fa-trash"></i></span>
                                                                <span className="btn-sm btn btn-warning" onClick={() => changeInventarioFromSucursalCentral(null, i, e.id, "update")}><i className="fa fa-pencil"></i></span>
                                                            </>
                                                            : null}
                                                        {e.type === "new" ?
                                                            <span className="btn-sm btn btn-danger" onClick={() => changeInventarioFromSucursalCentral(null, i, e.id, "delNew")}><i className="fa fa-times"></i></span>
                                                            : null}
                                                        {e.type === "update" ?
                                                            <span className="btn-sm btn btn-warning" onClick={() => changeInventarioFromSucursalCentral(null, i, e.id, "delModeUpdateDelete")}><i className="fa fa-times"></i></span>
                                                            : null}
                                                        {e.type === "delete" ?
                                                            <span className="btn-sm btn btn-danger" onClick={() => changeInventarioFromSucursalCentral(null, i, e.id, "delModeUpdateDelete")}><i className="fa fa-arrow-left"></i></span>
                                                            : null}
                                                    </div>
                                                </td>

                                            </tr>
                                        ) : <tr>
                                            <td colSpan={7}>Sin resultados</td>
                                        </tr>}
                                    </tbody>
                                </table>
                            </form>
                        </>
                    :null}            
                </div>
            </div>
        </div>
    )
}