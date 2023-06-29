function exportarExcel(extension, name){
    now =  new Date();
    filename = name+"-"+now;
    var table = document.getElementById('tblReporte');
    var wb = XLSX.utils.table_to_book(table, {sheet: "pedidos"});
    return XLSX.writeFile(wb, filename+"."+extension)
}