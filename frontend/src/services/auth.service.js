import { api } from "../lib/axios";

export const register = async (data) => {
    try {
        const response = await api.post("/register", data)
        return response.data
    } catch (error) {
        return error
    }
}
