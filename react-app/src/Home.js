import React, {useEffect, useState} from 'react';
import './App.css';
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
} from 'react-router-dom';
import Card from 'react-bootstrap/Card';
import CardColumns from 'react-bootstrap/CardColumns';
import Container from 'react-bootstrap/Container';
import ListGroup from 'react-bootstrap/ListGroup';
import Nav from 'react-bootstrap/Nav';
import axios from 'axios';

const Home = () => {
    const [astrologers, setAstrologers] = useState([]);

    useEffect(() => {
        const fetchAstrologers = async () => {
            const result = await axios('http://localhost:8089/astrologers', {headers: {'accept': 'application/json'}});
            setAstrologers(result.data);
        };
        fetchAstrologers().then();
    }, []);

    return (
        <div>
            <Container>
                <Nav>
                    <Nav.Item>
                        <Nav.Link disabled><h2>RobOracles</h2></Nav.Link>
                    </Nav.Item>
                </Nav>
                <div className="d-flex justify-content-center mt-3">
                    <Container className="d-flex flex-row flex-wrap">
                        <CardColumns>
                            {astrologers.map((astrologer, index) =>
                                <Card key={astrologer.id} className="mr-3 mb-3">
                                    <Card.Img variant="top" src={astrologer.photo}/>
                                    <Card.Body>
                                        <Card.Title className="text-center">{astrologer.name}</Card.Title>
                                        <Card.Header>Available Services:</Card.Header>
                                        <ListGroup variant="flush">
                                            {astrologers[index].services.map((service) =>
                                                <ListGroup.Item key={service.id}>{service.name}</ListGroup.Item>
                                            )}
                                        </ListGroup>
                                        <Link className="btn btn-primary" to={'/astrologer/' + astrologer.id}>More
                                            Details</Link>
                                    </Card.Body>
                                </Card>
                            )}
                        </CardColumns>
                    </Container>
                </div>
            </Container>
        </div>
    );
};

export default Home;
