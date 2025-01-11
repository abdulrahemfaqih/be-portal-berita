import { useState } from 'react'
import { authService } from '../../services/auth.service';
import toast, { Toaster } from 'react-hot-toast';
import { useNavigate } from 'react-router-dom';

export default function Register() {
    const navigate = useNavigate();
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        username: '',
        password: '',
        confirmPassword: ''
    });
    const [errors, setErrors] = useState({});
    const [loading, setLoading] = useState(false);

    function handleChange(e) {
        const { name, value } = e.target
        setFormData({ ...formData, [name]: value })
    }

    async function handleRegister(e) {
        e.preventDefault();
        setLoading(true);

        try {
            await authService.register(formData);
            toast.success("Register berhasil!")
            setTimeout(() => {
                navigate('/login');
            }, 1500);

        } catch (error) {
            if (error.status === 422) {
                setErrors(error.errors);
            }
            console.log('Registration failed:', error);
        } finally {
            setLoading(false);
        }
    }

    return (
        <>
            <h1 className='title'>Register a new account</h1>
            <form onSubmit={handleRegister} className='w-1/2 mx-auto space-y-4'>
                <div>
                    <input
                        type="text"
                        placeholder='Name'
                        value={formData.name}
                        name='name'
                        onChange={handleChange}
                        disabled={loading} />

                    {errors.name && <p className='error'>{errors.name}</p>}
                </div>
                <div>
                    <input
                        type="text"
                        placeholder='email'
                        value={formData.email}
                        name='email'
                        onChange={handleChange}
                        disabled={loading} />
                    {errors.email && <p className='error'>{errors.email}</p>}
                </div>
                <div>
                    <input
                        type="text"
                        placeholder='username'
                        value={formData.username}
                        name='username'
                        onChange={handleChange}
                        disabled={loading} />
                    {errors.username && <p className='error'>{errors.username}</p>}
                </div>
                <div>
                    <input
                        type="password"
                        placeholder='Password'
                        value={formData.password}
                        name='password'
                        onChange={handleChange}
                        disabled={loading} />
                    {errors.password && <p className='error'>{errors.password}</p>}
                </div>
                <div>
                    <input
                        type="password"
                        placeholder='Confim Password'
                        value={formData.passwordConfirmation}
                        name='confirmPassword'
                        onChange={handleChange}
                        disabled={loading} />
                    {errors.confirmPassword && <p className='error'>{errors.confirmPassword}</p>}
                </div>
                <button
                    className='primary-btn'
                >
                    {loading ? 'Registering...' : "Register"}
                </button>
            </form>
            <Toaster position="top-right" />
        </>
    )
}
