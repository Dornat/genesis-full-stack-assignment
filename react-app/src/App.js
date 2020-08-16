import React, {useEffect, useState} from 'react';
import './App.css';
import axios from 'axios';
import Card from 'react-bootstrap/Card';
import Container from 'react-bootstrap/Container';
import ListGroup from 'react-bootstrap/ListGroup';
import Button from 'react-bootstrap/Button';
import Nav from 'react-bootstrap/Nav';

const App = () => {
    const [astrologers, setAstrologers] = useState([]);

    useEffect(() => {
        const fetchAstrologers = async () => {
            const result = await axios('http://localhost:8089/astrologers', {headers: {'accept': 'application/json'}});
            setAstrologers(result.data);
        };
        fetchAstrologers();
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
                        {console.log(astrologers)}
                        {astrologers.map((astrologer, index) =>
                            <Card key={astrologer.id} className="mr-3 mb-3">
                                <Card.Img variant="top" src={astrologer.photo}/>
                                <Card.Body>
                                    <Card.Title className="text-center">{astrologer.name}</Card.Title>
                                    <Card.Header>Available Services:</Card.Header>
                                    <ListGroup variant="flush">
                                        {astrologers[index].services.map((service, i) =>
                                            <ListGroup.Item key={service.id}>{service.name}</ListGroup.Item>
                                        )}
                                    </ListGroup>
                                    <Button href="#">More Details</Button>
                                </Card.Body>
                            </Card>
                        )}
                    </Container>
                </div>
            </Container>
        </div>
    );
};

export default App;
