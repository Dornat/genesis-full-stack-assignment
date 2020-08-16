import React, {useEffect, useState} from 'react';
import {useParams} from 'react-router';
import axios from "axios";
import Card from 'react-bootstrap/Card';
import Button from 'react-bootstrap/Button';
import Container from 'react-bootstrap/Container';
import Table from 'react-bootstrap/Table';
import {Link} from "react-router-dom";
import ListGroup from "react-bootstrap/ListGroup";
import Modal from "react-bootstrap/Modal";
import CartForm from "./CartForm";

const Astrologer = () => {
    const {id} = useParams();
    const [astrologer, setAstrologer] = useState(null);
    const [cartBoxShow, setCartBoxShow] = useState(false);
    const [serviceInCart, setServiceInCart] = useState(null);

    const handleCartBoxShow = (serviceId) => {
        setCartBoxShow(true);
        setServiceInCart(serviceId);
    };
    const handleCardBoxClose = () => setCartBoxShow(false);

    useEffect(() => {
        const fetchAstrologer = async () => {
            const result = await axios('http://localhost:8089/astrologers/' + id, {headers: {'accept': 'application/json'}});
            setAstrologer(result.data);
        };
        fetchAstrologer().then();
    }, []);

    return (
        <div>
            <Container>
                {astrologer &&
                <Card className="mt-5 d-flex flex-row" style={{width: '100%'}}>
                    <Card.Img variant="top" style={{width: '18rem', height: '100%'}} src={astrologer.photo}/>
                    <Card.Body>
                        <Card.Title>{astrologer.personal_info}</Card.Title>
                        <Card.Subtitle className="mb-2 text-muted">{astrologer.email}</Card.Subtitle>
                        <Card.Text>{astrologer.bio}</Card.Text>
                        <ListGroup variant="flush">
                            <Table>
                                <tbody>
                                {astrologer.services.map((service) =>
                                    <tr key={service.id}>
                                        <td>{service.name}</td>
                                        <td>{service.price}$</td>
                                        <td>
                                            <Button onClick={() => handleCartBoxShow(service.id)}>Buy</Button>
                                        </td>
                                    </tr>
                                )}
                                </tbody>
                            </Table>
                        </ListGroup>
                    </Card.Body>
                </Card>}
                <Link className="btn btn-light mt-3" to="/">
                    Back to Dashboard
                </Link>
                {console.log(astrologer)}
            </Container>

            <Modal show={cartBoxShow} onHide={handleCardBoxClose}>
                <Modal.Header closeButton>Cart</Modal.Header>
                <Modal.Body>
                    <CartForm serviceId={serviceInCart}/>
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="secondary" onClick={handleCardBoxClose}>Close</Button>
                </Modal.Footer>
            </Modal>
        </div>
    );
};

export default Astrologer;
