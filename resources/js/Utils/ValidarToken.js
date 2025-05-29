
const checkAuth = async ()=>{
    try {
        const token = sessionStorage.getItem("token")

        const response = await fetch('/api/auth/checkToken', {
            credentials: 'include',
            method:"POST",
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            }
        })

        return response.ok
    } catch (error) {

        return false
    }
}
export default checkAuth
