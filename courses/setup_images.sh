#!/bin/bash

# Verificar se a pasta uploads existe
if [ ! -d "uploads" ]; then
  mkdir uploads
fi

# Copiar as imagens para a pasta uploads
cp -R imgs/* uploads/

# Ajustar as permissões das imagens
chmod -R 755 uploads/

echo "Imagens copiadas com sucesso para a pasta uploads."
