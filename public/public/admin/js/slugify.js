// slugify.js
function slugify(str) {
    return str.toLowerCase()
        .normalize('NFD')                   // tách ký tự có dấu thành ký tự + dấu
        .replace(/[\u0300-\u036f]/g, '')    // xóa dấu tiếng Việt
        .replace(/[^a-z0-9\s-]/g, '')       // xóa ký tự đặc biệt
        .trim()
        .replace(/\s+/g, '-')               // thay khoảng trắng bằng dấu -
        .replace(/-+/g, '-')                // gộp nhiều dấu -
        .replace(/^-+|-+$/g, '');           // xóa - ở đầu và cuối
}
