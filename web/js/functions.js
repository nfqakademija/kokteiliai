/**
 * Created by Audrius on 14.4.22.
 */
function addProduct(product)
{
    var user = "@HttpContext.Current.User";

    //user.addIngredient(product);

    return confirm(product.toString());
}