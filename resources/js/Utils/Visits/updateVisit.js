const token = sessionStorage.getItem('token')
const updateVisit = async (data, id) => {


    const response = await fetch(`/api/visit/${id}`, {
        method: 'PUT',
        credentials: 'include',
        headers: {
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    });

    console.log(response.statusText)
    if (!response.ok) throw new Error("Error al actualizar una visita");

    const respo = await response.json();
    return respo;

}

export default updateVisit
