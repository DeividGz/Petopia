function deleteData(url) {
    Swal.fire({
        title: 'Tem certeza que deseja excluir esse dado?',
        showDenyButton: true,
        confirmButtonText: 'Confirmar',
        denyButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Sucesso!', 'O dado foi excluído!', 'success')
            window.location.href = url
        } else if (result.isDenied) {
            Swal.fire('Cancelado!', 'Nenhum dado foi apagado', 'info')
        }
    })
}