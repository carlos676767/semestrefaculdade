import express from "express";
import http from "http";
import { Server } from "socket.io";
import bodyParser from "body-parser";

import axios from "axios";


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

    console.log(userId);
    

    io.to(userId).emit("sucesso", {
      mensagem: "Pagamento confirmado!",
 
    });


    const data = await axios.get(`http://localhost:8000/updateItens/${userId}`)

    console.log(data);
    
  }


  res.sendStatus(200);
});

server.listen(3000, () => console.log("Servidor Socket.IO rodando na porta 3000 🚀"));
