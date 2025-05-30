const token = sessionStorage.getItem('token')
const deleteVisit = async (id) => {


    const response = await fetch(`/api/visit/${id}`, {
        method: 'DELETE',
        credentials: 'include',
        headers: {
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });

    console.log(response.statusText)
    if (!response.ok) throw new Error("Error al eliminar una visita");

    const respo = await response.json();
    return respo;

}

export default deleteVisit
