# archivo creado para hacer los inserts de las imagenes
# $ python3 iterador.py >> sql/inserts_productos.sql

import os
import random

# Ruta del directorio a listar
directorio = "./stock"

# Categorías y rangos de precio
categorias_disponibles = ["vectorial", "dibujo", "abstracto", "arte", "logo", "ícono"]
rango_precio = [10, 100]

# Iterar sobre los archivos del directorio
for archivo in os.listdir(directorio):
    # Verificar que el elemento es un archivo y no un directorio
    if os.path.isfile(os.path.join(directorio, archivo)):
        # Generar precio aleatorio con dos decimales
        precio = round(random.uniform(rango_precio[0], rango_precio[1]), 2)
        
        # Seleccionar aleatoriamente entre 1 y 3 categorías
        num_categorias = random.randint(1, 3)
        categorias_seleccionadas = random.sample(categorias_disponibles, num_categorias)
        categorias_string = ' '.join(categorias_seleccionadas)
        
        print(f"""INSERT INTO productos (precio, imagen_url, categorias) VALUES
    ({int(precio)}, '{archivo}', '{categorias_string}');""")