// Retorna o caminho raiz da aplicação web
function getRootPath() {

    var relativePath = window.location.pathname;
    var absolutePath = window.location.href;
    var rootPath = absolutePath.split(relativePath);

    return rootPath[0];
}