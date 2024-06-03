// Fungsi untuk membuat data baru (Create)
async function createData(url, data) {
    const response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="_token"]')
                .content,
        },
        body: JSON.stringify(data),
    });
    return response.json();
}

// Fungsi untuk membaca data (Read)
async function readData(url) {
    const response = await fetch(url);
    return response.json();
}

// Fungsi untuk memperbarui data (Update)
async function updateData(url, data) {
    const response = await fetch(url, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="_token"]')
                .content,
        },
        body: JSON.stringify(data),
    });
    return response.json();
}

// Fungsi untuk menghapus data (Delete)
async function deleteData(url) {
    const response = await fetch(url, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="_token"]')
                .content,
        },
    });
    return response.json();
}
