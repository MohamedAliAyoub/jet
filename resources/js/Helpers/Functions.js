const exportExcel = () => {
let url = (window.location.href).split("?");
window.location.href = (typeof url[1] == 'undefined' ? url[0] + '?export_excel=true' : (window.location.href) + '&export_excel=true');
}
export { exportExcel }
