import { PrismaClient } from '@prisma/client'
const prisma = new PrismaClient()

export default defineEventHandler(async (event) => {
  const productId = Number(event.context.params.id);

  const product = await prisma.products.findUnique({
    where: { id: productId },
    include: { images: true } // Include related images
  });

  return product;
})