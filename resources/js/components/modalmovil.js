import { useEffect } from "react"

export default function Modalmovil({
    x,
    y,
    setmodalmovilshow,
    modalmovilshow,
    getProductos,
    productos,
    linkproductocentralsucursal,
    inputbuscarcentralforvincular,
}) {
    useEffect(()=>{
        if (inputbuscarcentralforvincular) {
            if (inputbuscarcentralforvincular.current) {
                inputbuscarcentralforvincular.current.focus()
            }
        }
    },[modalmovilshow])
    return (
        <div className="modalmovil" style={{top:y+42,left:x}}>
            <div className="w-100 btn mb-1 btn-sm" onClick={()=>setmodalmovilshow(false)}>
                <i className="fa fa-times text-danger"></i>
            </div>
            
            <h5>Productos Centro de Acopio</h5>
            <input type="text" className="form-control" placeholder="Buscar en centro de Acopio..." ref={inputbuscarcentralforvincular}  onChange={e=>getProductos(e.target.value)}/>
            
            <table className="table">
                <thead>
                    <tr>
                        <td></td>
                        <th>C. Alterno</th>
                        <th>C. Barras</th>
                        <th>Unidad</th>
                        <th>Descripción</th>
                        <th>Base</th>
                        <th>Venta</th>
                        <th>Categoría/Proveedor</th>
                    </tr>
                </thead>
                <tbody>
                {productos.length?productos.map(e=>
                    <tr key={e.id} data-id={e.id} className="pointer align-middle">
                        <td> <button className="btn btn-outline-success" onClick={()=>linkproductocentralsucursal(e.id)}><i className="fa fa-link fa-2x"></i> <br /> #{e.id}</button></td>
                        <td>{e.codigo_proveedor}</td>
                        <td>{e.codigo_barras}</td>
                        <td>{e.unidad}</td>
                        <td>{e.descripcion}</td>
                        <td>{e.precio_base}</td>
                        <td className="text-success">{e.precio}</td>
                        <td>{e.id_categoria}/{e.id_proveedor}</td>
                    </tr>
                ):null}
                </tbody>
            </table>
        </div>
    )
}