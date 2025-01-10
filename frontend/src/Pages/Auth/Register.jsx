import React, { useState } from 'react'
import { register } from '../../services/auth.service';


export default function Register() {
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        password: '',
        passwordConfirmation: ''
    });

    function handleChange(e) {
        const { name, value } = e.target
        setFormData({ ...formData, [name]: value })
    }

    async function handleRegister(e) {
        e.preventDefault();
        try {
            const response = await register(formData);
            console.log('Registration successful:', response);

        } catch (error) {
            console.error('Registration failed:', error.message);
        }
    }

    return (
        <>
            <h1 className='title'>Register a new account</h1>
            <form onSubmit={handleRegister} className='w-1/2 mx-auto space-y-6'>
                <div>
                    <input type="text" placeholder='Name' value={formData.name} name='name' onChange={handleChange} />
                </div>
                <div>
                    <input type="text" placeholder='email' value={formData.email} name='email' onChange={handleChange} />
                </div>
                <div>
                    <input type="password" placeholder='Password' value={formData.password} name='password' onChange={handleChange} />
                </div>
                <div>
                    <input type="password" placeholder='Confim Password' value={formData.passwordConfirmation} name='passwordConfimation' onChange={handleChange} />
                </div>
                <button className='primary-btn'>Register</button>
            </form>
        </>
    )
}
