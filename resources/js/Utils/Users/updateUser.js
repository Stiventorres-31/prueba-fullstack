const token = sessionStorage.getItem('token')
const updateUser = async (data, id) => {


    const response = await fetch(`/api/user/${id}`, {
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
    if (!response.ok) throw new Error("Error al actualizar un usuaro");

    const respo = await response.json();
    return respo;

}

export default updateUser
