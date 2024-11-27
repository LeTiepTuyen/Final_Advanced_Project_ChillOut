import { PrismaClient } from "@prisma/client";
const prisma = new PrismaClient();

export default defineEventHandler(async (event) => {
  const body = await readBody(event);

  try {
    // Kiểm tra sự tồn tại của tất cả các productId
    const productIds = body.items.map((item) => item.productId);
    const existingProducts = await prisma.products.findMany({
      where: { id: { in: productIds } },
    });

    if (existingProducts.length !== productIds.length) {
      throw new Error("One or more product IDs are invalid");
    }

    const order = await prisma.orders.create({
      data: {
        userId: body.userId,
        name: body.name,
        address: body.address,
        zipcode: body.zipcode,
        city: body.city,
        country: body.country,
        orderItem: {
          create: body.items.map((item) => ({
            productId: item.productId,
          })),
        },
      },
    });

    return order;
  } catch (error) {
    console.error("Failed to create order:", error);
    throw createError({
      statusCode: 500,
      statusMessage: "Failed to create order",
    });
  }
});
