import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';
import React, {useEffect, useState} from 'react';
import axios from 'axios';
import Alert from 'react-bootstrap/Alert';

const CartForm = ({serviceId}) => {
    const [email, setEmail] = useState('');
    const [name, setName] = useState('');
    const [showForm, setShowForm] = useState(true);
    const [success, setSuccess] = useState(null);
    const [isLoading, setIsLoading] = useState(false);

    const handleEmailChange = (e) => setEmail(e.target.value);
    const handleNameChange = (e) => setName(e.target.value);

    const handleSubmit = (e) => {
        e.preventDefault();
        setIsLoading(true);

        axios.post('http://localhost:8089/carts', {
            buyerEmail: email,
            buyerName: name,
            service: 'services/' + serviceId
        }).then((response) => {
            setShowForm(false);
            setSuccess(true);
        }).catch((error) => {
            setShowForm(false);
            setSuccess(false);
        });
    };

    return (
        <div>
            {showForm &&
            <Form onSubmit={handleSubmit}>
                <Form.Group controlId="email">
                    <Form.Label>Email address</Form.Label>
                    <Form.Control type="email" placeholder="Enter email" value={email} onChange={(e) => handleEmailChange(e)} required/>
                    <Form.Text className="text-muted">
                        We'll never share your email with anyone else.
                    </Form.Text>
                </Form.Group>

                <Form.Group controlId="name">
                    <Form.Label>Name</Form.Label>
                    <Form.Control type="text" placeholder="Enter your name" value={name} onChange={(e) => handleNameChange(e)} required/>
                </Form.Group>
                <Button variant="primary" type="submit" disabled={isLoading}>
                    {isLoading ? 'Loading...' : 'Submit'}
                </Button>
            </Form>}
            {success === true
                ? <Alert variant="success">Your order has been successfully processed!</Alert>
                : !showForm && <Alert variant="danger">Something went wrong... =(</Alert>
            }
        </div>
    );
};

export default CartForm;
