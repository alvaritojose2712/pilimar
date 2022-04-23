export default function Historicocierre({
	cierres,
	fechaGetCierre,
	setfechaGetCierre,
	getCierres,
	verCierreReq,
	fechaGetCierre2,
	setfechaGetCierre2,
}) {
	return (
		<div className="container-fluid">
			<div className="input-group">
				<input type="date" className="form-control" value={fechaGetCierre} onChange={e => setfechaGetCierre(e.target.value)} />
				<input type="date" className="form-control" value={fechaGetCierre2} onChange={e=>setfechaGetCierre2(e.target.value)}/>
				<div className="inputr-group-append">
					<button className="btn" onClick={getCierres}><i className="fa fa-search"></i></button>
				</div>
			</div>
			<table className="table table-sm">
				<thead>
					<tr>
						<td>Fecha</td>
						<th>Débito</th>
						<th>Efectivo</th>
						<th>Transferencia</th>
						<th>Dejar $</th>
						<th>Dejar COP</th>
						<th>Dejar BS.</th>
						<th>Guardado $</th>
						<th>Guardado COP</th>
						<th>Guardado BS</th>
						<th>Tasa</th>
					</tr>
					{cierres ? cierres.cierres ? cierres.cierres.length ? cierres.cierres.map(e=>
						<tr key={e.id}>
							<th>{e.fecha}</th>
							<td>{e.debito}</td>
							<td>{e.efectivo}</td>
							<td>{e.transferencia}</td>
							<td>{e.dejar_dolar}</td>
							<td>{e.dejar_peso}</td>
							<td>{e.dejar_bss}</td>
							<td>{e.efectivo_guardado}</td>
							<td>{e.efectivo_guardado_cop}</td>
							<td>{e.efectivo_guardado_bs}</td>
							<td>{e.tasa}</td>
							<td>
								<button className="btn btn-outline-success" onClick={()=>verCierreReq(e.fecha)} type="button">Ver</button>
								<button className="btn btn-outline-success" onClick={()=>verCierreReq(e.fecha,"enviar")} type="button"><i className="fa fa-send"></i></button>
							</td>
						</tr>

					):null:null:null}
				</thead>
			</table>
			{cierres?cierres.numventas?
				<table className="table">
					<thead>
						<tr>
							<th>numventas</th>
							<th>debito</th>
							<th>efectivo</th>
							<th>transferencia</th>
							<th>ganancia</th>
							<th>porcentaje</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{cierres.numventas}</td>
							<td>{cierres.debito}</td>
							<td>{cierres.efectivo}</td>
							<td>{cierres.transferencia}</td>
							<td>{cierres.ganancia}</td>
							<td>{cierres.porcentaje}</td>
						</tr>
					</tbody>
				</table>
			:null:null}
		</div>
	)
}