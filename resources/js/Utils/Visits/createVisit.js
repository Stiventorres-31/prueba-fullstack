const token = sessionStorage.getItem('token')
const createVisit = async (data) => {
    try {
        const response = await fetch('/api/visit', {
            method: 'POST',
            credentials: 'include',
            headers: {
                Authorization: `Bearer ${token}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify(data)
        });

        // console.log(response)
        // if (!response.ok) throw new Error('Error al crear una visita');

        const responseData = await response.json();
        console.log(responseData)
        return responseData;
    } catch (error) {
        return error.message
    }

}

export default createVisit
