import api from './axios';

class AuthService {
    async register(userData) {
        try {
            const response = await api.post('/register', userData);
            return response.data;
        } catch (error) {
            if (error.response?.status === 422) {
                throw {
                    status: 422,
                    errors: error.response.data.errors
                };
            }
            throw error;
        }
    }
}

export const authService = new AuthService();