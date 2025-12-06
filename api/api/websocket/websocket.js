import express from "express";
import http from "http";
import { Server } from "socket.io";
import bodyParser from "body-parser";

import axios from "axios";

import WebSocket, { WebSocketServer } from 'ws';

const wss = new WebSocketServer({ port: 8080 });


const app = express();
const server = http.createServer(app);
const io = new Server(server, { cors: { origin: "*" } });

app.use(bodyParser.json());

const connectedUsers = new Map();

io.on("connection", (socket) => {



  const { idUser } = socket.handshake.query;
  if (!idUser) return socket.disconnect();

 
  console.log(`Usuário conectado: ${idUser}`);
  socket.join(idUser);

  connectedUsers.set(idUser, socket.id);

  socket.on("disconnect", () => {
    connectedUsers.delete(idUser);
    console.log(`Usuário desconectado: ${idUser}`);
 
  });
});




app.post("/webHookStripe", async(req, res) => {
    
  const event = req.body;
 
  
  if (event.type === "checkout.session.completed") {
    const session = event.data.object;
    const userId = session.metadata.user_id; 


    

    io.to(userId).emit("sucesso", {
      mensagem: "Pagamento confirmado!",
 
    });
    


    



   
  

    await axios.get(`http://localhost:8000/updateItens/${userId}`)


    
  }


  res.sendStatus(200);
});




app.post('/mercadoPago', async(req, res) => {
  if (req.body.action === `payment.updated`) {
    const [[chave, valor]] = connectedUsers.entries();
    await axios.get(`http://localhost:8000/updateItens/${Number(chave)}`)



    emitAllWebsocketjs(io)

  }
  res.sendStatus(201);
});





app.post("/updateStatusWp", (req, res) => {
  const { userId, itemAtt, newStatus } = req.body;

  io.to(String(userId)).emit("ws", {
      msg: `o item ${itemAtt} foi atualizado para o status ${newStatus}`
  });

  res.sendStatus(201);
});


server.listen(3000, () => console.log("Servidor Socket.IO rodando na porta 3000 🚀")); 